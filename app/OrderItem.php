<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'dish_id',
        'name',
        'price',
        'quantity',
        'cost',
    ];
    /* ... */
    /**
     * Связь «элемент принадлежит» таблицы `order_items` с таблицей `dishes`
     */
    public function dish() {
        return $this->belongsTo(Dish::class);
    }
}
