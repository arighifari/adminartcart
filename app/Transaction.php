<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',	'transaction',	'amount', 'status', 'pesanan_diproses', 'pesanan_dikirim', 'pesanan_diterima', 'pesanan_dibuat'
    ];

    public function users(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
