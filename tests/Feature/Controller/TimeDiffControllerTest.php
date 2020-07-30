<?php

namespace Tests\Feature\Controller;

use App\Transaction;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TimeDiffControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function testExample()
    {
        $user = User::create([
            'name' => 'ArtCart',
            'email' => 'admin@artcart.com',
            'password' => Hash::make('admin12345'),
            'dob'=> '1998-02-10',
            'gender'=> 'M',
            'balance' => '500000',
            'phone_num' => '85938369897',
            'bio' => 'Admin Account',
            'home_address' => 'Ciganitri',
            'admin' => 1
        ]);
        $user = User::create([
            'name' => 'Robert',
            'email' => 'Robert@artcart.com',
            'password' => Hash::make('admin12345'),
            'dob'=> '1998-02-10',
            'gender'=> 'M',
            'balance' => '500000',
            'phone_num' => '85938369897',
            'bio' => 'Admin Account',
            'home_address' => 'Ciganitri'
        ]);
        $user = User::create([
            'name' => 'Justin',
            'email' => 'Justin@artcart.com',
            'password' => Hash::make('admin12345'),
            'dob'=> '1998-02-10',
            'gender'=> 'M',
            'balance' => '500000',
            'phone_num' => '85938369897',
            'bio' => 'Admin Account',
            'home_address' => 'Ciganitri'
        ]);

        $trans = Transaction::create([
            'user_id' => 1,
            'transaction' => 'bank_transfer',
            'amount' => 20000,
            'status' => 4,
            'pesanan_diproses' => Carbon::parse('2020-07-20 15:23:23')->addHours(10)->toDateTimeString(),
            'pesanan_dikirim' => Carbon::parse('2020-07-20 15:23:23')->addHours(12)->toDateTimeString(),
            'pesanan_diterima' => Carbon::parse('2020-07-20 15:23:23')->addHours(90)->toDateTimeString(),
            'pesanan_dibuat' => Carbon::now()->format('2020-07-20 15:23:23')
        ]);

        $trans = Transaction::create([
            'user_id' => 3,
            'transaction' => 'bank_transfer',
            'amount' => 10000,
            'status' => 4,
            'pesanan_diproses' => Carbon::parse('2020-07-20 15:23:23')->addHours(4)->toDateTimeString(),
            'pesanan_dikirim' => Carbon::parse('2020-07-20 15:23:23')->addHours(15)->toDateTimeString(),
            'pesanan_diterima' => Carbon::parse('2020-07-20 15:23:23')->addHours(60)->toDateTimeString(),
            'pesanan_dibuat' => Carbon::now()->format('2020-07-20 15:23:23')
        ]);
        $trans = Transaction::create([
            'user_id' => 1,
            'transaction' => 'bank_transfer',
            'amount' => 30000,
            'status' => 4,
            'pesanan_diproses' => Carbon::parse('2020-07-20 15:23:23')->addHours(6)->toDateTimeString(),
            'pesanan_dikirim' => Carbon::parse('2020-07-20 15:23:23')->addHours(20)->toDateTimeString(),
            'pesanan_diterima' => Carbon::parse('2020-07-20 15:23:23')->addHours(80)->toDateTimeString(),
            'pesanan_dibuat' => Carbon::now()->format('2020-07-20 15:23:23')
        ]);
        $trans = Transaction::create([
            'user_id' => 2,
            'transaction' => 'bank_transfer',
            'amount' => 60000,
            'status' => 4,
            'pesanan_diproses' => Carbon::parse('2020-07-20 15:23:23')->addHours(6)->toDateTimeString(),
            'pesanan_dikirim' => Carbon::parse('2020-07-20 15:23:23')->addHours(20)->toDateTimeString(),
            'pesanan_diterima' => Carbon::parse('2020-07-20 15:23:23')->addHours(80)->toDateTimeString(),
            'pesanan_dibuat' => Carbon::now()->format('2020-07-20 15:23:23')
        ]);
        $trans = Transaction::create([
            'user_id' => 2,
            'transaction' => 'bank_transfer',
            'amount' => 50000,
            'status' => 4,
            'pesanan_diproses' => Carbon::parse('2020-07-20 15:23:23')->addHours(6)->toDateTimeString(),
            'pesanan_dikirim' => Carbon::parse('2020-07-20 15:23:23')->addHours(20)->toDateTimeString(),
            'pesanan_diterima' => Carbon::parse('2020-07-20 15:23:23')->addHours(80)->toDateTimeString(),
            'pesanan_dibuat' => Carbon::now()->format('2020-07-20 15:23:23')
        ]);
        $trans = Transaction::create([
            'user_id' => 2,
            'transaction' => 'bank_transfer',
            'amount' => 40000,
            'status' => 4,
            'pesanan_diproses' => Carbon::parse('2020-06-20 15:23:23')->addHours(7)->toDateTimeString(),
            'pesanan_dikirim' => Carbon::parse('2020-06-20 15:23:23')->addHours(18)->toDateTimeString(),
            'pesanan_diterima' => Carbon::parse('2020-06-20 15:23:23')->addHours(72)->toDateTimeString(),
            'pesanan_dibuat' => Carbon::now()->format('2020-06-20 15:23:23')
        ]);
        $trans = Transaction::create([
            'user_id' => 3,
            'transaction' => 'bank_transfer',
            'amount' => 40000,
            'status' => 4,
            'pesanan_diproses' => Carbon::parse('2020-06-20 15:23:23')->addHours(9)->toDateTimeString(),
            'pesanan_dikirim' => Carbon::parse('2020-06-20 15:23:23')->addHours(16)->toDateTimeString(),
            'pesanan_diterima' => Carbon::parse('2020-06-20 15:23:23')->addHours(100)->toDateTimeString(),
            'pesanan_dibuat' => Carbon::now()->format('2020-06-20 15:23:23')
        ]);
        $trans = Transaction::create([
            'user_id' => 3,
            'transaction' => 'bank_transfer',
            'amount' => 40000,
            'status' => 4,
            'pesanan_diproses' => Carbon::parse('2020-06-20 15:23:23')->addHours(9)->toDateTimeString(),
            'pesanan_dikirim' => Carbon::parse('2020-06-20 15:23:23')->addHours(16)->toDateTimeString(),
            'pesanan_diterima' => Carbon::parse('2020-06-20 15:23:23')->addHours(100)->toDateTimeString(),
            'pesanan_dibuat' => Carbon::now()->format('2020-06-20 15:23:23')
        ]);

        //waktu bulan ini
        $diterima = Transaction::whereMonth('pesanan_dibuat', Carbon::now()->startOfMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->get();

        $waktu = [];
        //hitung selisih pengiriman
        foreach ($diterima as $total => $value ){
            $dibuat = Carbon::parse($value->pesanan_dibuat);
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
        $selisih1 = CarbonInterval::seconds($rata2)->cascade()->forHumans();


        //hitung selisih proses
        foreach ($diterima as $total => $value ){
            $dibuat = Carbon::parse($value->pesanan_dibuat);
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
        $selisih4 = CarbonInterval::seconds($rata2)->cascade()->forHumans();

        $this->assertEquals('3 days 6 hours',$selisih1);
        $this->assertEquals('6 hours 24 minutes',$selisih2);
        $this->assertEquals('11 hours',$selisih3);
        $this->assertEquals('2 days 12 hours 36 minutes',$selisih4);

    }
}
