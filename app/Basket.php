<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    public function dishes() {
        return $this->belongsToMany(Dish::class)->withPivot('quantity');
    }
    /**
     * Увеличивает кол-во товара $id в корзине на величину $count
     */
    public function increase($id, $count = 1) {
        $this->change($id, $count);
    }

    /**
     * Уменьшает кол-во товара $id в корзине на величину $count
     */
    public function decrease($id, $count = 1) {
        $this->change($id, -1 * $count);
    }

    /**
     * Изменяет количество товара $id в корзине на величину $count;
     * если товара еще нет в корзине — добавляет этот товар; $count
     * может быть как положительным, так и отрицательным числом
     */
    private function change($id, $count = 0) {
        if ($count == 0) {
            return;
        }
        // если товар есть в корзине — изменяем кол-во
        if ($this->dishes->contains($id)) {
            // получаем объект строки таблицы `basket_product`
            $pivotRow = $this->dishes()->where('dish_id', $id)->first()->pivot;
            $quantity = $pivotRow->quantity + $count;
            if ($quantity > 0) {
                // обновляем количество товара $id в корзине
                $pivotRow->update(['quantity' => $quantity]);
            } else {
                // кол-во равно нулю — удаляем товар из корзины
                $pivotRow->delete();
            }
        } elseif ($count > 0) { // иначе — добавляем этот товар
            $this->dishes()->attach($id, ['quantity' => $count]);
        }
        // обновляем поле `updated_at` таблицы `baskets`
        $this->touch();
    }

    /**
     * Удаляет товар с идентификатором $id из корзины покупателя
     */
    public function remove($id) {
        // удаляем товар из корзины (разрушаем связь)
        $this->dishes()->detach($id);
        // обновляем поле `updated_at` таблицы `baskets`
        $this->touch();
    }

    public function getAmount() {
        $amount = 0.0;
        foreach ($this->dishes as $dish) {
            $amount = $amount + $dish->price * $dish->pivot->quantity;
        }
        return $amount;
    }

}
