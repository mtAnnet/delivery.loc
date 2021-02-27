<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basket;
use App\Order;
use App\OrderStatus;
use App\Promocode;
use App\UsedPromocode;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class BasketController extends Controller
{
    private $basket;
    public function __construct() {
        $this->getBasket();
    }

    //Показывает корзину покупателя
    public function index() {
        $dishes = $this->basket->dishes;
        return view('basket.index', compact('dishes'));
    }
    //Оформление заказа
    public function checkout() {
        return view('basket.checkout');
    }
     //Добавляет товар с идентификатором $id в корзину
    public function add(Request $request, $id) {
        $quantity = $request->input('quantity') ?? 1;
        $this->basket->increase($id, $quantity);
        // выполняем редирект обратно на ту страницу,
        // где была нажата кнопка «В корзину»
        return back()->withCookie(cookie('basket_id', $this->basket->id, 525600));
    }
     //Увеличивает кол-во товара $id в корзине на единицу
    public function plus($id) {
        $this->basket->increase($id);
        // выполняем редирект обратно на страницу корзины
        return redirect()->route('basket.index');
    }
    //Уменьшает кол-во товара $id в корзине на единицу
    public function minus($id) {
        $this->basket->decrease($id);
        // выполняем редирект обратно на страницу корзины
        return redirect()->route('basket.index');
    }
     // Возвращает объект корзины; если не найден — создает новый
    private function getBasket() {
        $basket_id = request()->cookie('basket_id');
        if (!empty($basket_id)) {
            try {
                $this->basket = Basket::findOrFail($basket_id);
            }
            catch (ModelNotFoundException $e) {
                $this->basket = Basket::create();
            }
        } else {
            $this->basket = Basket::create();
        }
        Cookie::queue('basket_id', $this->basket->id, 525600);
    }
     //Удаляет товар с идентификаторм $id из корзины
    public function remove($id) {
        $this->basket->remove($id);
        // выполняем редирект обратно на страницу корзины
        return redirect()->route('basket.index');
    }
     //Полностью очищает содержимое корзины покупателя
    public function clear() {
        $this->basket->delete();
        // выполняем редирект обратно на страницу корзины
        return redirect()->route('basket.index');
    }
     //Сохранение заказа в БД
    public function saveOrder(Request $request) {
        // проверяем данные формы оформления
        $this->validate($request, [
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
        ]);
        // валидация пройдена, сохраняем заказ
        $basket = $this->basket;
        $order = new Order();
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->comment = $request->comment;
        $order->user_id = Auth::id();

        if(!isset($request->promocode)) {
            $order->amount = $basket->getAmount();
        }
        if(isset($request->promocode)) {
            $canUsePromo = Promocode::select('promocode')->where('user_id', '=', Auth::id())
                ->where('is_used', '=', false)->first();
            if ($canUsePromo['promocode'] === $request->promocode) {
                $order->amount = $basket->getAmount()*0.8;
                Promocode::where('user_id', '=', Auth::id())->update(
                    ['is_used' => 1]
                );
            }
            else{
                $order->amount = $basket->getAmount();
            }
        }
        $order->save();
        foreach ($basket->dishes as $dish) {
            $order->items()->create([
                'dish_id' => $dish->id,
                'name' => $dish->name,
                'price' => $dish->price,
                'quantity' => $dish->pivot->quantity,
                'cost' => $dish->price * $dish->pivot->quantity,
            ]);
        }
        // уничтожаем корзину
        $basket->delete();
        return redirect()
            ->route('basket.success')
            ->with( 'order_id',$order->id);
    }
     //Сообщение об успешном оформлении заказа
    public function success(Request $request) {
        if ($request->session()->exists('order_id')) {
            // сюда юзер попадает сразу после успешного оформления заказа
            $order_id = $request->session()->pull('order_id');
            $order = Order::with('user', 'status')->findOrFail($order_id);
            return view('basket.success', compact('order'));
        } else {
            // если покупатель попал сюда случайно, не после оформления заказа,
            // отправляем на страницу корзины
            return redirect()->route('basket.index');
        }
    }

    public  function countBasketItems(){
        return $this->basket->dishes;
    }
}







