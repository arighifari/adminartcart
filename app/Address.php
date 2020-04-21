<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'zip', 'kelurahan', 'kecamatan', 'jenis', 'kabupaten', 'provinsi'
    ];

    public function users()
    {
        return $this->hasOne('App\User','address','id');
    }

    public function jenis()
    {
        if($this->jenis == 'Kab.') {
            return 'Kabupaten';
        } else {
            return 'Kota';
        }
    }

    public function alamatKota()
    {
        return $this->jenis." ".$$this->kabupaten;
    }
}
