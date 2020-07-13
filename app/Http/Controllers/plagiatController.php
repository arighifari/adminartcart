<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class plagiatController extends Controller
{
    public function index(){
        $diterima = Product::select('status')->where('status',1)->get()->count();
        $dievaluasi = Product::select('status')->where('status',2)->get()->count();
        $dibanding = Product::select('status')->where('status',3)->get()->count();
        $ditolak = Product::select('status')->where('status',4)->get()->count();

//        dd($diterima,$dievaluasi,$dibanding,$ditolak);

        $data_array = array(
            'data'=> [
            $diterima,
            $dievaluasi,
            $dibanding,
            $ditolak]
        );

        return $data_array;
    }
}
