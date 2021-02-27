<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Restaurant extends Model
{
    use Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    //One restaurant belongs to one cuisine

    public function cuisines(){
        return $this->belongsToMany('App\Cuisine', 'restaurant_cuisines');
    }

    public function cities(){
        return $this->belongsToMany('App\City', 'restaurant_cities');
    }
    public function relationRestaurantCuisine($cuisines){
        foreach ($cuisines as $cuisine){
            $rel = new RestaurantCuisine();
            $rel->cuisine_id = $cuisine;
            $rel->restaurant_id = $this->id;
            $rel->save();
        }
    }
    public function relationRestaurantCity($cities){
        foreach ($cities as $city){
            $rel = new RestaurantCity();
            $rel->city_id = $city;
            $rel->restaurant_id = $this->id;
            $rel->save();
        }
    }

    public function dishes(){
        return $this->hasMany('App\Dish');
    }
    public function like()
    {
        return $this->hasMany('App\Like')->where('LIKE', '=', '1');
    }
}
