<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class transactionController extends Controller
{
    function transaction(){

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
//        return $year_array;
        $income = Transaction::select('amount')->get();
        return view('transaction', compact('income'))->with('year_array',$year_array);
    }

    function year($year){
        $year_array = array();

        $posts_dates = Transaction::whereRaw('substr(created_at,1,4) ='.$year)->orderBy( 'created_at', 'ASC' )->pluck( 'created_at' );
        $posts_dates = json_decode( $posts_dates );

        if ( ! empty( $posts_dates ) ) {
            foreach ( $posts_dates as $unformatted_date ) {
                $date = new \DateTime( $unformatted_date);
                $year = $date->format( 'Y' );
                $year_array[] = $year;
                $year_array = array_unique($year_array);
            }
        }

        return $year_array;
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

        $monthly_post_count = Transaction::whereMonth( 'created_at', $month )->get()->count();

        return $monthly_post_count;
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
            $monthly_post_count = Transaction::whereMonth( 'created_at', $month )->get()->count();
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
