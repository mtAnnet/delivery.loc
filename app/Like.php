<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'restaurant_id', 'like'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    public function likeRestaurant()
    {
        $this->update(['like' => $this->like ? 0 : 1]);
        return true;
    }
}
