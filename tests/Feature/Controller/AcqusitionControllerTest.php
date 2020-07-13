<?php

namespace Tests\Feature\Controller;

use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AcqusitionControllerTest extends TestCase
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
//            $divide_retention = $change_retention / $count_retention_last;
            $divide_acq = ($acq_now-$acq_last) / $acq_last *100;
        }


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
            'acqusition_change' => $result,
            'percentage' => $result2
        );
//        dd($monthly_post_count_array,$acq_now,$acq_last);

        //check values of $count_retention_now
        $this->assertEquals(3,$acq_now);
        //check values of $percentage_retention
        $this->assertEquals(50,$divide_acq);

        //check array key months in $monthly_post_data_array
        $this->assertArrayHasKey('months',$monthly_post_data_array);
        //check arrat value of $month_name_array
        $this->assertContains('Jan',$month_name_array);
        //check array key post_count_data in $monthly_post_data_array
        $this->assertArrayHasKey('post_count_data',$monthly_post_data_array);
        //check array value of $monthly_post_count_array
        $this->assertContains(3,$monthly_post_count_array);
        //check array key acqusition_change in $monthly_post_data_array
        $this->assertArrayHasKey('acqusition_change',$monthly_post_data_array);
        //check array value of $result
        $this->assertContains(1,$result);
        //check array key percentage in $monthly_post_data_array
        $this->assertArrayHasKey('percentage',$monthly_post_data_array);
        //check array value of $result2
        $this->assertContains(50,$result2);
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
        return $month_array;
    }


    function getMonthlyPostCount( $month ) {

        //current customer acqusition
        $acqusition = Transaction::select('user_id')->whereYear('pesanan_dibuat', Carbon::now()->startOfYear()->format('Y'))
            ->whereMonth( 'pesanan_dibuat', $month )->distinct()->get();
        $acq_now = count($acqusition);

        return $acq_now;
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
        $max = round(( $max_no + 10/2 ) / 10 ) * 10;
        $monthly_post_data_array = array(
            'months' => $month_name_array,
            'post_count_data' => $monthly_post_count_array,
            'max' => $max,
        );

        return $monthly_post_data_array;

    }

    function getYearPostCount( $month , $year) {

        if ($year == null){
            $monthly_post_count = Transaction::whereMonth( 'pesanan_dibuat', $month )->count();
        }
        else {
            $monthly_post_count = Transaction::whereRaw('substr(created_at,1,4) ='.$year)->whereMonth( 'pesanan_dibuat', $month )->get()->count();
        }
        return $monthly_post_count;
    }

    function getYearPostData($year) {
        $monthly_post_count_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if ( ! empty( $month_array ) ) {
            foreach ( $month_array as $month_no => $month_name ){
                $monthly_post_count = $this->getYearPostCount( $month_no , $year  );
                array_push( $monthly_post_count_array, $monthly_post_count );
                array_push( $month_name_array, $month_name );
            }
        }

        $max_no = max( $monthly_post_count_array );
        $max = round(( $max_no + 10/2 ) / 10 ) * 10;
        $monthly_post_data_array = array(
            'months' => $month_name_array,
            'post_count_data' => $monthly_post_count_array,
            'max' => $max,
        );

        return $monthly_post_data_array;
    }

}
