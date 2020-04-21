<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'balance', 'phone_num', 'address', 'admin', 'photo', 'job', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function fname(){
        $words = explode(" ", trim($this->name) );
        return strtoupper($words[0]);
    }

    public function balance(){
        return number_format($this->balance);
    }

    public function rates(){
        return $this->hasMany('App\Rate', 'user_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany('App\Cart','user_id','id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review','user_id','id');
    }

    public function addresses()
    {
        return $this->belongsTo('App\Address','address','id');
    }

    public function checkProfileData()
    {
        $arr_check = [
            $this->dob,
            $this->gender,
            $this->phone_num,
            $this->bio,
            $this->address,
            $this->home_address
        ];

        foreach ($arr_check as $value) {
            if($value == null) {
                return false;
                break;
            } else {
                return true;
            }
        }
    }
//    use Notifiable;
//
//    /**
//     * The attributes that are mass assignable.
//     *
//     * @var array
//     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];
//
//    /**
//     * The attributes that should be hidden for arrays.
//     *
//     * @var array
//     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];
//
//    /**
//     * The attributes that should be cast to native types.
//     *
//     * @var array
//     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
//
}
