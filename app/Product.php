<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'cat_id','brand_id','user_id','title','price','description','image','keyword', 'special'
    ];

    public function carts(){
        return $this->hasMany('App\Cart', 'product_id', 'id');
    }

    public function wishlists(){
        return $this->hasMany('App\Wishlist', 'product_id', 'id');
    }

    public function rates(){
        return $this->hasMany('App\Rate', 'user_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review','product_id','id');
    }

    public function categories(){
        return $this->belongsTo('App\Categories', 'cat_id', 'id');
    }

    public function users(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function price(){
        return number_format($this->price);
    }
}
