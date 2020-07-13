<?php

namespace Tests\Feature\Controller;

use App\Product;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
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

        $year_now = Carbon::now()->startOfYear()->format('Y');

        //Get Year Dropdown
        $year_array = array();
        $posts_dates = Transaction::orderBy( 'pesanan_dibuat', 'ASC' )->pluck( 'created_at' );
        $posts_dates = json_decode( $posts_dates );
        if ( ! empty( $posts_dates ) ) {
            foreach ( $posts_dates as $unformatted_date ) {
                $date = new \DateTime( $unformatted_date);
                $year = $date->format( 'Y' );
                $year_array[] = $year;
                $year_array = array_unique($year_array);
            }
        }

        //Percentage Revenue
        $currentmonth = date('m');
        $total_rev = 0;

        $revenue = Transaction::select('amount')->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->
        format('Y'))->get();
        foreach ($revenue as $in)
            $total_rev += $in->amount;
        //last month
        $revenue_last = Transaction::whereMonth('pesanan_dibuat', Carbon::now()->subMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->get();
        $last_rev = 0;
        foreach ($revenue_last as $in)
            $last_rev += $in->amount;

        $revenue = Transaction::whereMonth('pesanan_dibuat', Carbon::now()->startOfMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->get();
        $current_rev = 0;
        foreach ($revenue as $in)
            $current_rev += $in->amount;

        $change_rev = $current_rev - $last_rev;
        if ($change_rev == 0){
            $divide_rev = 0;
        }
        elseif ($last_rev == 0) {
            $divide_rev = 0;
        }
        else{
//            $divide_rev = $change_rev / $last_rev;
            $divide_rev = $change_rev / $last_rev;
        }

        //count percentage revenue
        $percentage_rev = $divide_rev * 100;

        //Total Transaction Current Month
        $month_transaction = Transaction::whereMonth('pesanan_dibuat', Carbon::now()->startOfMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->count();
        //last month
        $last_month_transaction = Transaction::whereMonth('pesanan_dibuat', Carbon::now()->subMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->count();

        //Total User
        $user = User::count();


        //Current Average Order Value
        if ($current_rev == 0){
            $average_order = 0;
        }
        else{
            $average_order = $current_rev / $month_transaction;
        }

        //Last Avergae Order Value
        if ($last_rev == 0){
            $last_average_order = 0;
        }
        else{
//            $divide_rev = $change_rev / $last_rev;
            $last_average_order = $last_rev / $last_month_transaction;
        }

        $change_aov = $average_order - $last_average_order;
        if ($change_rev == 0){
            $divide_aov = 0;
        }
        elseif ($last_average_order == 0) {
            $divide_aov = 0;
        }
        else{
            $divide_aov = $change_aov / $last_average_order;
        }

        //count percentage aov
        $percentage_aov = $divide_aov * 100;

        //customer retention
        //customer retention this month
        $retention = Transaction::select('id','user_id')->whereMonth('pesanan_dibuat', Carbon::now()->startOfMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->get();
        $group_retenteion1 = $retention->groupBy('user_id');
        $new_total = [];
        foreach ($group_retenteion1 as $total => $value){
            if(sizeof($value)>1){
                $new_total[$total]=sizeof($value);
            }

        }
        $count_retention_now = count($new_total) ;

        //customer retention last month
        $retention_last = Transaction::select('id','user_id')->whereMonth('pesanan_dibuat', Carbon::now()->subMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->get();

        $group_retention2 = $retention_last->groupBy('user_id');
        $new_total2 = [];
        foreach ($group_retention2 as $total => $value){
            if(sizeof($value)>1){
                $new_total2[$total]=sizeof($value);
            }
        }
        $count_retention_last = count($new_total2);

        $change_retention = $count_retention_now - $count_retention_last;
        if ($count_retention_last == 0){
            $divide_retention = 0;
        }
        else{
            $divide_retention = $change_retention / $count_retention_last;
        }
        $percentage_retention = $divide_retention * 100;

        //current customer acqusition
        $acqusition = Transaction::select('user_id')->whereMonth('pesanan_dibuat', Carbon::now()->startOfMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->distinct()->get();
        $acq_now = count($acqusition);

        //customer acqusition last month
        $acqusition = Transaction::select('user_id')->whereMonth('pesanan_dibuat', Carbon::now()->subMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->distinct()->get();
        $acq_last = count($acqusition);

        if ($acq_last == 0){
            $divide_acq = 0;
        }
        else{
            $divide_acq = ($acq_now-$acq_last) / $acq_last *100;
        }

        //new product
        $product = Product::select()->whereMonth('pesanan_dibuat', Carbon::now()->startOfMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->distinct()->count();

        //rata-rata pengiriman
        $diterima = Transaction::whereMonth('pesanan_dibuat', Carbon::now()->startOfMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->get();
        $waktu = [];
        foreach ($diterima as $total => $value ){
            $dibuat = Carbon::parse($value->pesanan_dibuat);
            $waktu_diterima = Carbon::parse($value->pesanan_diterima);
            $waktu[$total]= $dibuat->diffInSeconds($waktu_diterima);
        }

        $total_waktu = 0;
        foreach ($waktu as $total){
            $total_waktu += $total;
        }
        $jumlah_transaksi = count($diterima);
        $rata2 = $total_waktu/$jumlah_transaksi;
        $selisih = CarbonInterval::seconds($rata2)->cascade()->forHumans();

//        dd($selisih);

//        dd($selisih,$percentage_retention,$divide_acq,$product,$percentage_rev,$current_rev,$percentage_aov,$average_order);

        $this->assertEquals('3 days 6 hours',$selisih);
        $this->assertEquals(100,$percentage_retention);
        $this->assertEquals(50,$divide_acq);
        $this->assertEquals(0,$product);
        $this->assertEquals(41.666666666667,$percentage_rev);
        $this->assertEquals(170000,$current_rev);
        $this->assertEquals(-15.0,$percentage_aov);
        $this->assertEquals(34000,$average_order);


    }
}
