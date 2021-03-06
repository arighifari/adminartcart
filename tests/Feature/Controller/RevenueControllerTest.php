<?php

namespace Tests\Feature\Controller;

use App\Transaction;
use App\User;
use Carbon\Carbon;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RevenueControllerTest extends TestCase
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
        //year array
        $year_array = array();
        $posts_dates = Transaction::orderBy( 'pesanan_dibuat', 'ASC' )->pluck( 'pesanan_dibuat' );
        $posts_dates = json_decode( $posts_dates );

        if ( ! empty( $posts_dates ) ) {
            foreach ( $posts_dates as $unformatted_date ) {
                $date = new \DateTime( $unformatted_date);
                $year = $date->format( 'Y' );
                $year_array[] = $year;
                $year_array = array_unique($year_array);
            }
        }

        $year_now = Carbon::now()->startOfYear()->format('Y');
        //year array
        $year_array = array();
        $posts_dates = Transaction::orderBy( 'pesanan_dibuat', 'ASC' )->pluck( 'pesanan_dibuat' );
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
        $total_rev = 0;
        //current year
        $revenue = Transaction::select('amount')->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->
        format('Y'))->get();
        foreach ($revenue as $in)
            $total_rev += $in->amount;
        //current month
        $revenue = Transaction::whereMonth('pesanan_dibuat', Carbon::now()->startOfMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->get();
        $current_rev = 0;
        foreach ($revenue as $in)
            $current_rev += $in->amount;
        //last month
        $revenue_last = Transaction::whereMonth('pesanan_dibuat', Carbon::now()->subMonth()->format('m'))
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->get();
        $last_rev = 0;
        foreach ($revenue_last as $in)
            $last_rev += $in->amount;

        $change_rev = $current_rev - $last_rev;
        if ($change_rev == 0){
            $divide_rev = 0;
        }
        elseif ($last_rev == 0) {
            $divide_rev = 0;
        }
        else{
            $divide_rev = $change_rev / $last_rev;
        }
        //count percentage revenue
        $percentage_rev = $divide_rev * 100;

        $monthly_post_count_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if ( ! empty( $month_array ) ) {
            foreach ( $month_array as $month_no => $month_name ){
                $monthly_post_count = $this->getMonthlyPostCount( $month_no);
                array_push( $monthly_post_count_array, $monthly_post_count );
                array_push( $month_name_array, $month_name );
            }
        }

        //revenue change
        $i = 1;
        $result_arr0[] = $monthly_post_count_array[0];
        while ( $i < sizeof($monthly_post_count_array)) {
            $result_arr1[$i] = $monthly_post_count_array[$i]-$monthly_post_count_array[$i-1];
            if ($i == sizeof($monthly_post_count_array)-1) {
                break;
            }
            $i++;
        }
        $result = array_merge($result_arr0,$result_arr1);

        $i = 1;
        $result_arr2[] = $monthly_post_count_array[0];
        while ( $i < sizeof($monthly_post_count_array)) {
            if ($monthly_post_count_array[$i-1] == 0){
                $result_arr1[$i] = 0;
            }
            else{
                $result_arr1[$i] = ($monthly_post_count_array[$i]-$monthly_post_count_array[$i-1])/$monthly_post_count_array[$i-1]*100;
            }
            if ($i == sizeof($monthly_post_count_array)-1) {
                break;
            }
            $i++;
        }
        $result2 = array_merge($result_arr2,$result_arr1);

        $monthly_post_data_array = array(
            'months' => $month_name_array,
            'post_count_data' => $monthly_post_count_array,
            'revenue_change' => $result,
            'percentage' => $result2
        );

        $arr_rev = array($current_rev);
        $arr_change = array($change_rev);
        $arr_percent = array($percentage_rev);

        $revenue_data = array(
            'revenue' => $arr_rev,
            'change_rev' => $arr_change,
            'percentage_rev' => $arr_percent
        );
//        dd($monthly_post_count_array);

        //check array key revenue in $revenue_data
        $this->assertArrayHasKey('revenue',$revenue_data);
        //check array value of $array_rev
        $this->assertContains(170000,$arr_rev);
        //check array key change_rev in $revenue_data array
        $this->assertArrayHasKey('change_rev',$revenue_data);
        //check array value of $arr_change
        $this->assertContains(50000,$arr_change);
        //check array key revenue in $revenue_data array
        $this->assertArrayHasKey('revenue',$revenue_data);
        //check value of $percentage_rev
        $this->assertEquals(41.666666666667,$percentage_rev);
        //check array key months in $monthly_post_data_array
        $this->assertArrayHasKey('months',$monthly_post_data_array);
        //check arrat value of $month_name_array
        $this->assertContains('Jan',$month_name_array);
        //check array key post_count_data in $monthly_post_data_array
        $this->assertArrayHasKey('post_count_data',$monthly_post_data_array);
        //check array value of $monthly_post_count_array
        $this->assertContains(170000,$monthly_post_count_array);
        //check array key revenue_change in $revenue_data array
        $this->assertArrayHasKey('revenue_change',$monthly_post_data_array);
        //check array value of $result
        $this->assertContains(0,$result);
        //check array key percentage in $revenue_data array
        $this->assertArrayHasKey('percentage',$monthly_post_data_array);
        //check array value of $result2
        $this->assertContains(0,$result2);
    }

    function getAllMonths(){
        $month_array = array();
        $posts_dates = Transaction::orderBy( 'pesanan_dibuat', 'ASC' )->pluck( 'pesanan_dibuat' );
        $posts_dates = json_decode( $posts_dates );

        if ( ! empty( $posts_dates ) ) {
            foreach ( $posts_dates as $unformatted_date ) {
                $date = new \DateTime( $unformatted_date);
                $month_no = $date->format( 'm' );
                $month_name = $date->format( 'M' );
                for ($m=1; $m<=12; ++$m){
                    $alldate_no = date('m',mktime(0, 0, 0, $m, 1)) ;
                    $alldate_name = date('M',mktime(0, 0, 0, $m, 1)) ;

                    $all_month[ $alldate_no ] = $alldate_name ;
                }
                $month_array[ $month_no ] = $month_name;
                $month_array = $all_month;
            }
        }
        $this->assertEquals('Jul',$month_name);
        return $month_array;
    }

    function getMonthlyPostCount( $month ) {
        $revenue = Transaction::whereMonth( 'pesanan_dibuat', $month )
            ->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))->get();
        $current_rev = 0;
        foreach ($revenue as $in)
            $current_rev += $in->amount;
        return $current_rev;
    }

    function getMonthlyPostData() {
        $monthly_post_count_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if ( ! empty( $month_array ) ) {
            foreach ( $month_array as $month_no => $month_name ){
                $monthly_post_count = $this->getMonthlyPostCount( $month_no);
                array_push( $monthly_post_count_array, $monthly_post_count );
                array_push( $month_name_array, $month_name );
            }
        }
        $max_no = max( $monthly_post_count_array );
//        $max = round(( $max_no + 10/2 ) / 10 ) * 10;
        $max_length = strlen((string)$max_no);
        $max_length = $max_length - 2;
        $max = round($max_no,-$max_length);
        $monthly_post_data_array = array(
            'months' => $month_name_array,
            'post_count_data' => $monthly_post_count_array,
            'max' => $max,
        );
        return $monthly_post_data_array;

    }
}
