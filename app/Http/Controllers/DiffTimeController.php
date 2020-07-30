<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

class DiffTimeController extends Controller
{
    public function index(){
        //waktu bulan ini
        $diterima = Transaction::whereRaw('MONTH(created_at) = ?', Carbon::now()->startOfMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();

        $waktu = [];
        //hitung selisih pengiriman
        foreach ($diterima as $total => $value ){
            $dibuat = Carbon::parse($value->created_at);
            $waktu_diterima = Carbon::parse($value->pesanan_diterima);
            $waktu[$total]= $dibuat->diffInSeconds($waktu_diterima);
//            $selisih_waktu = abs($dibuat-$waktu_diterima);
        }

        $total_waktu = 0;
        foreach ($waktu as $total){
            $total_waktu += $total;
        }
        $jumlah_transaksi = count($diterima);
        if ($total_waktu == 0){
            $rata2 = 0;
        }
        else{
            $rata2 = $total_waktu/$jumlah_transaksi;
        }
        $rata2 = number_format($rata2,0,'.','');

        $selisih1 = CarbonInterval::seconds($rata2)->cascade()->forHumans();

        //hitung selisih proses
        foreach ($diterima as $total => $value ){
            $dibuat = Carbon::parse($value->created_at);
            $waktu_diproses = Carbon::parse($value->pesanan_diproses);
            $waktu[$total]= $dibuat->diffInSeconds($waktu_diproses);
//            $selisih_waktu = abs($dibuat-$waktu_diterima);
        }

        $total_waktu = 0;
        foreach ($waktu as $total){
            $total_waktu += $total;
        }
        $jumlah_transaksi = count($diterima);
        if ($total_waktu == 0){
            $rata2 = 0;
        }
        else{
            $rata2 = $total_waktu/$jumlah_transaksi;
        }
        $rata2 = number_format($rata2,0,'.','');

        $selisih2 = CarbonInterval::seconds($rata2)->cascade()->forHumans();

        //hitung selisih dikirim
        foreach ($diterima as $total => $value ){
            $dibuat = Carbon::parse($value->pesanan_diproses);
            $waktu_diproses = Carbon::parse($value->pesanan_dikirim);
            $waktu[$total]= $dibuat->diffInSeconds($waktu_diproses);
//            $selisih_waktu = abs($dibuat-$waktu_diterima);
        }

        $total_waktu = 0;
        foreach ($waktu as $total){
            $total_waktu += $total;
        }
        $jumlah_transaksi = count($diterima);
        if ($total_waktu == 0){
            $rata2 = 0;
        }
        else{
            $rata2 = $total_waktu/$jumlah_transaksi;
        }
        $rata2 = number_format($rata2,0,'.','');
        $selisih3 = CarbonInterval::seconds($rata2)->cascade()->forHumans();

        //hitung selisih diterima
        foreach ($diterima as $total => $value ){
            $dibuat = Carbon::parse($value->pesanan_dikirim);
            $waktu_diproses = Carbon::parse($value->pesanan_diterima);
            $waktu[$total]= $dibuat->diffInSeconds($waktu_diproses);
//            $selisih_waktu = abs($dibuat-$waktu_diterima);
        }

        $total_waktu = 0;
        foreach ($waktu as $total){
            $total_waktu += $total;
        }
        $jumlah_transaksi = count($diterima);
        if ($total_waktu == 0){
            $rata2 = 0;
        }
        else{
            $rata2 = $total_waktu/$jumlah_transaksi;
        }
        $rata2 = number_format($rata2,0,'.','');
        $selisih4 = CarbonInterval::seconds($rata2)->cascade()->forHumans();

        return view('SelisihWaktu')->with('selisih1',$selisih1)->with('selisih2',$selisih2)->with('selisih3',$selisih3)->
        with('selisih4',$selisih4);
    }
}
