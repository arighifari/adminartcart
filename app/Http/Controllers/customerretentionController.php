<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class customerretentionController extends Controller
{
    public function index()
    {
        $year_now = Carbon::now()->startOfYear()->format('Y');
        //year array
        $year_array = array();
        $posts_dates = Transaction::orderBy('created_at', 'ASC')->pluck('created_at');
        $posts_dates = json_decode($posts_dates);

        if (!empty($posts_dates)) {
            foreach ($posts_dates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $year = $date->format('Y');
                $year_array[] = $year;
                $year_array = array_unique($year_array);
            }
        }

        //customer retention
        //customer retention this month
        $retention = Transaction::select('id', 'user_id')->whereRaw('MONTH(created_at) = ?', Carbon::now()->startOfMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();
        $group_retention1 = $retention->groupBy('user_id');
        $new_total = [];
        foreach ($group_retention1 as $total => $value) {
            if (sizeof($value) > 1) {
                $new_total[$total] = sizeof($value);
            }
        }
        $count_retention_now = count($new_total);

        //customer retention last month
        $retention_last = Transaction::select('id', 'user_id')->whereRaw('MONTH(created_at) = ?', Carbon::now()->subMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();

        $group_retention2 = $retention_last->groupBy('user_id');
        $new_total2 = [];
        foreach ($group_retention2 as $total => $value) {
            if (sizeof($value) > 1) {
                $new_total2[$total] = sizeof($value);
            }
        }
        $count_retention_last = count($new_total2);

        $change_retention = $count_retention_now - $count_retention_last;
        if ($count_retention_last == 0) {
            $divide_retention = 0;
        } else {
            $divide_retention = $change_retention / $count_retention_last;
        }
        $percentage_retention = $divide_retention * 100;

        $monthly_post_count_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if (!empty($month_array)) {
            foreach ($month_array as $month_no => $month_name) {
                $monthly_post_count = $this->getMonthlyPostCount($month_no);
                array_push($monthly_post_count_array, $monthly_post_count);
                array_push($month_name_array, $month_name);
            }
        }

        $monthly_post_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if (!empty($month_array)) {
            foreach ($month_array as $month_no => $month_name) {
                $monthly_post = $this->getMonthlyCount($month_no);
                array_push($monthly_post_array, $monthly_post);
                array_push($month_name_array, $month_name);
            }
        }

//        return $monthly_post_array;


        $i = 1;
        $result_arr0[] = $monthly_post_count_array[0];
        while ( $i < sizeof($monthly_post_count_array)) {
            $result_arr1[$i] = $monthly_post_count_array[$i]-$monthly_post_count_array[$i-1];
            if ($i == sizeof($monthly_post_count_array)-1) {
                break;
            }
            $i++;
        }
        $result = array_merge([0],$result_arr1);

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
        $result2 = array_merge([0],$result_arr1);


        $monthly_post_data_array = array(
            'months' => $month_name_array,
            'post_count_data' => $monthly_post_count_array,
            'retention_change' => $result,
            'percentage' => $result2,
            'desc' =>$monthly_post_array
        );

//        dd($monthly_post_data_array);

        return view('customerretention')->with('retention_now',$count_retention_now)->with('percentage_retention',$percentage_retention)
            ->with('year_array',$year_array)->with('year_now',$year_now)->with('data_table',$monthly_post_data_array)->with('month_data',$result)
            ->with('description', $monthly_post_array);
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

    function getMonthlyCount( $month ) {

        //customer retention this month
        $monthly_post_count = Transaction::with('users')->select('user_id')->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))
            ->whereMonth( 'created_at', $month )->get();
        $group_retention1 = $monthly_post_count ->groupBy('user_id');
        $new_total = [];
        foreach ($group_retention1 as $total => $value){
            if(sizeof($value)>1){
                $name = $value[0]['users']['name'];
                $new_total[$name]=sizeof($value);
            }
        }
        $count_retention = $new_total;

        return $count_retention;
    }

    function getMonthlyPostData() {
        $monthly_post_count_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if ( ! empty( $month_array ) ) {
            foreach ( $month_array as $month_no => $month_name ){
                $monthly_post_count = $this->getMonthlyPostCount($month_no);
                array_push( $monthly_post_count_array, $monthly_post_count );
                array_push( $month_name_array, $month_name );
            }
        }

//        dd($monthly_post_count_array);
        $max_no = max( $monthly_post_count_array );
//        dd($max_no);
        $max = round(( $max_no + 10/2 ) / 10 ) * 10 ;
        $monthly_post_data_array = array(
            'months' => $month_name_array,
            'post_count_data' => $monthly_post_count_array,
            'max' => $max,
        );

        return $monthly_post_data_array;

    }

    function getYearPostCount( $month , $year) {

        //customer retention this month
        if ($year == null){
            $monthly_post_count = Transaction::select('id','user_id')->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))
                ->whereMonth( 'created_at', $month )->get();
            $group_retention1 = $monthly_post_count ->groupBy('user_id');
            $new_total = [];
            foreach ($group_retention1 as $total => $value){
                if(sizeof($value)>1){
                    $new_total[$total]=sizeof($value);
                }
            }
            $count_retention = count($new_total);
        }
        else {
            $monthly_post_count = Transaction::select('id','user_id')
                ->whereRAW('substr(created_at,1,4) ='.$year)
                ->whereMonth( 'created_at', $month )->get();
            $group_retention1 = $monthly_post_count ->groupBy('user_id');
            $new_total = [];
            foreach ($group_retention1 as $total => $value){
                if(sizeof($value)>1){
                    $new_total[$total]=sizeof($value);
                }
            }
            $count_retention = count($new_total);
        }

        return $count_retention;
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
//        dd($monthly_post_count_array);
        $max_no = max( $monthly_post_count_array );
//        dd($max_no);
        $max = round(( $max_no + 10/2 ) / 10 ) * 10 ;
        $monthly_post_data_array = array(
            'months' => $month_name_array,
            'post_count_data' => $monthly_post_count_array,
            'max' => $max,
        );

        return $monthly_post_data_array;
    }
}
