<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'transaction_id',	'product_id',	'user_id',	'qty'
    ];

    public function products(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
