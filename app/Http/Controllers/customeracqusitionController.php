<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class customeracqusitionController extends Controller
{
    public function index(){
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

        //current customer acqusition
        $acqusition = Transaction::select('user_id')->whereRaw('MONTH(created_at) = ?', Carbon::now()->startOfMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->distinct()->get();
        $acq_now = count($acqusition);

        //customer acqusition last month
        $acqusition = Transaction::select('user_id')->whereRaw('MONTH(created_at) = ?', Carbon::now()->subMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->distinct()->get();
        $acq_last = count($acqusition);

        $divide_acq = ($acq_now-$acq_last) / $acq_last *100;

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

        return view('customeracqusition')->with('acq_now',$acq_now)->with('percentage_acq',$divide_acq)
            ->with('year_array',$year_array)->with('year_now',$year_now)->with('data_table',$monthly_post_data_array)->with('month_data',$result);
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

        //current customer acqusition
        $acqusition = Transaction::select('user_id')->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))
            ->whereMonth( 'created_at', $month )->distinct()->get();
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
            $monthly_post_count = Transaction::whereMonth( 'created_at', $month )->count();
        }
        else {
            $monthly_post_count = Transaction::whereRaw('substr(created_at,1,4) ='.$year)->whereMonth( 'created_at', $month )->get()->count();
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
