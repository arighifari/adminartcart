<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'product_id',	'user_id',	'rate',	'comment'
    ];

    public function users(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function products(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
