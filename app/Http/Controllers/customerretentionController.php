<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class customerretentionController extends Controller
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

        //customer retention
        //customer retention this month
        $retention = Transaction::select('id','user_id')->whereRaw('MONTH(created_at) = ?', Carbon::now()->startOfMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();
        $group_retenteion1 = $retention->groupBy('user_id');
        $new_total = [];
        foreach ($group_retenteion1 as $total => $value){
            if(sizeof($value)>1){
                $new_total[$total]=sizeof($value);
            }
        }
        $count_retention_now = count($new_total);

        //customer retention last month
        $retention_last = Transaction::select('id','user_id')->whereRaw('MONTH(created_at) = ?', Carbon::now()->subMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();

        $group_retention2 = $retention_last->groupBy('user_id');
        $new_total2 = [];
        foreach ($group_retention2 as $total => $value){
            if(sizeof($value)>1){
                $new_total2[$total]=sizeof($value);
            }
        }
        $count_retention_last = count($new_total2);

        $change_retention = $count_retention_now - $count_retention_last;
        $divide_retention = $change_retention / $count_retention_last;
        $percentage_retention = $divide_retention * 100;

        return view('customerretention')->with('retention_now',$count_retention_now)->with('percentage_retention',$percentage_retention)
            ->with('year_array',$year_array)->with('year_now',$year_now);
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

        //customer retention this month
        $monthly_post_count = Transaction::select('id','user_id')->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))
            ->whereMonth( 'created_at', $month )->get();
        $group_retention1 = $monthly_post_count ->groupBy('user_id');
        $new_total = [];
        foreach ($group_retention1 as $total => $value){
            if(sizeof($value)>1){
                $new_total[$total]=sizeof($value);
            }
        }
        $count_retention_now = count($new_total);

        return $count_retention_now;
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
