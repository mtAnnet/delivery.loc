<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $fillable = [
        'is_used'

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function userPromocode($user_id){
        $promo = new Promocode();
        $promo->user_id = $user_id;
        $promo->promocode = bin2hex(random_bytes(5));
        $promo->is_used = false;
        $promo->save();
    }


}
