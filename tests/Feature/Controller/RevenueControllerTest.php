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

        $trans = Transaction::create([
            'user_id' => '1',
            'transaction' => 'bank_transfer',
            'amount' => 10000,
            'status' => rand(1,4),
            'created_at' => Carbon::now()->format('2020-7-20 15:23:23'),
            'updated_at' => Carbon::now()->format('2020-7-20 15:23:23')
        ]);
        $trans = Transaction::create([
            'user_id' => 1,
            'transaction' => 'bank_transfer',
            'amount' => 10000,
            'status' => rand(1,4),
            'created_at' => Carbon::now()->format('2020-7-20 15:23:23'),
            'updated_at' => Carbon::now()->format('2020-7-20 15:23:23')
        ]);
        $trans = Transaction::create([
            'user_id' => 1,
            'transaction' => 'bank_transfer',
            'amount' => 10000,
            'status' => rand(1,4),
            'created_at' => Carbon::now()->format('2020-6-20 15:23:23'),
            'updated_at' => Carbon::now()->format('2020-6-20 15:23:23')
        ]);
        $trans = Transaction::create([
            'user_id' => 1,
            'transaction' => 'bank_transfer',
            'amount' => 10000,
            'status' => rand(1,4),
            'created_at' => Carbon::now()->format('2020-6-20 15:23:23'),
            'updated_at' => Carbon::now()->format('2020-6-20 15:23:23')
        ]);

        $year_now = Carbon::now()->startOfYear()->format('Y');
        //year array
        $year_array = array();
        $posts_dates = Transaction::orderBy( 'created_at', 'ASC' )->pluck( 'created_at' );
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
        $revenue = Transaction::select('amount')->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y') )->get();
        dd($revenue);
        foreach ($revenue as $in)
            $total_rev += $in->amount;
        //current month
        $revenue = Transaction::where('MONTH(created_at) = ?', Carbon::now()->startOfMonth()->format('m'))
            ->where('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();
        dd($revenue);
        $current_rev = 0;
        foreach ($revenue as $in)
            $current_rev += $in->amount;
        //last month
        $revenue_last = Transaction::whereRaw('(created_at) = ?', Carbon::now()->subMonth()->format('m'))
            ->whereRAW('(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();
        $last_rev = 0;
        foreach ($revenue_last as $in)
            $last_rev += $in->amount;

        $change_rev = $current_rev - $last_rev;
        if ($change_rev == 0){
            $divide_rev = 0;
        }
        else{
//            $average_order = $current_rev / $month_transaction;
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
//            $result_arr1[$i] = 0;
//            $result_arr1[$i] = ($monthly_post_count_array[$i]-$monthly_post_count_array[$i-1])/$monthly_post_count_array[$i-1]*100;
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
//        return $monthly_post_data_array;


        $arr_rev = array($current_rev);
        $arr_change = array($change_rev);
        $arr_percent = array($percentage_rev);

        $revenue_data = array(
            'revenue' => $arr_rev,
            'change_rev' => $arr_change,
            'percentage_rev' => $arr_percent
        );

        $response = $this->get('/rev',[$revenue_data],[$year_array],[$year_now],[$monthly_post_data_array],[$result]);
        $response->assertStatus(200);
//        $response->assertDontSee('revenue');

    }
    function getAllMonths(){
        $month_array = array();
        $posts_dates = Transaction::orderBy( 'created_at', 'ASC' )->pluck( 'created_at' );
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
        return $month_array;
    }


    function getMonthlyPostCount( $month ) {


        $revenue = Transaction::whereMonth( 'created_at', $month )
            ->whereRAW('(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();
        $current_rev = 0;
        foreach ($revenue as $in)
            $current_rev += $in->amount;
//        $acq_now = count($acqusition);

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
