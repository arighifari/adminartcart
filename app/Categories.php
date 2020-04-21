<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'title'
    ];

    public function products(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
