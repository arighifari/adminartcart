<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'product_id','user_id','qty'
    ];

    public function products(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function users(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
