<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class revenueController extends Controller
{
    function revenue(){
        return view('revenue');
    }

    function getAllMonths(){
        $month_array = array();
        $all_month = array();
        $posts_dates = Transaction::orderBy( 'created_at', 'ASC' )->pluck( 'created_at' );
        $posts_dates = json_decode( $posts_dates );

    if ( ! empty( $posts_dates ) ) {
            foreach ( $posts_dates as $unformatted_date ) {

            }
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

        return $month_array;
    }


    function getRevenue ($months){
        $total = 0;
        $rev = Transaction::select('amount')->whereMonth('created_at', $months)->get();
        foreach ($rev as $total_rev) {
            $total += $total_rev->amount;
        }
        return $total;
    }

    function getMonthlyPostCount( $month ) {
        $monthly_post_count = Transaction::whereMonth( 'created_at', $month )->get()->count();
        return $monthly_post_count;
    }

    function getMonthlyPostData() {

        $monthly_post_count_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();

        if ( ! empty( $month_array ) ) {
            foreach ( $month_array as $month_no => $month_name ){
                $monthly_post_count = $this->getRevenue( $month_no );
                array_push( $monthly_post_count_array, $monthly_post_count );
                array_push( $month_name_array, $month_name );
            }
        }


        $max_no = max( $monthly_post_count_array );
        $max = round(( $max_no ) / 10 ) * 10;
        $monthly_post_data_array = array(
            'months' => $month_name_array,
            'post_count_data' => $monthly_post_count_array,
            'max' => $max,
        );

        return $monthly_post_data_array;

    }
}
