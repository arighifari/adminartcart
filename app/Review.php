<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    protected $fillable = [
        'user_id','product_id','rating','comment',
    ];

    public function users()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function products()
    {
        return $this->belongsTo('App\Product','product_id','id');
    }
}
