<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DishController extends Controller
{
    public static function getAllDishes(){
        //у одного блюда не должно быть много ресторанов потому что подразумевается выводить форичем несколько ресторанов
        $dishes = Dish::with('restaurant')->get();
        return $dishes;
    }
    public function addNewDish(Request $request){
        $data = $request->all();
        $image = $request->image->store('uploads', 'public');
        $validator = Validator::make($data, [
            'name' => 'required|max:255|min:5',
            'price' =>'required|numeric|min:10',
            'ingredients' => 'required|max:255|min:20',
            'time_for_preparing' => 'required|max:255|min:5',
        ]);
        $dish = new Dish();
        $dish->name = $data['name'];
        $dish->image = $image;
        $dish->ingredients = $data['ingredients'];
        $dish->price = $data['price'];
        $dish->time_for_preparing = $data['time_for_preparing'];
        $dish->restaurant_id = $data['restaurant'];
        $dish->save();
        return redirect(route('admin.dishes'));
    }
    public function searchByName(Request $request){
        $searchQuery = $request->dishSearchByName;
        if(!empty($searchQuery))
        {
            $dishes = Dish::with('restaurant')
                ->where('name', 'LIKE', '%' . $searchQuery. '%')
                ->get();
            return view('admin.dishes')
                    ->with('dishes',$dishes)
                    ->with('restaurants', RestaurantController::getAllRestaurants());
        }
        else
        {
            return redirect(route('admin.dishes'));
        }
    }
    public function delete($id){
        $dish = Dish::find($id);
        $dish->delete();
        return redirect(route('admin.dishes'));
    }
}
