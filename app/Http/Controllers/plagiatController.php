<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class plagiatController extends Controller
{
    public function index(){
        $pending = Product::select('status')->where('status',0)->get()->count();
        $ditolak = Product::select('status')->where('status',1)->get()->count();
        $diterima = Product::select('status')->where('status',2)->get()->count();
        $dibanding = Product::select('status')->where('status',4)->get()->count();
        $banding_ditolak = Product::select('status')->where('status',4)->get()->count();
        $banding_diterima = Product::select('status')->where('status',5)->get()->count();

//        dd($diterima,$dievaluasi,$dibanding,$ditolak);

        $data_array = array(
            'data'=> [
                $pending,
                $ditolak,
                $diterima,
                $dibanding,
                $banding_ditolak,
                $banding_diterima
            ]
        );

        return $data_array;
    }
}
