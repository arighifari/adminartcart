<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function dashboard(){

        $transaction = Order::count();
        $user = User::count();

        return view ('dashboard',compact('transaction','user'));
    }

    public function home(){
        $year_now = Carbon::now()->startOfYear()->format('Y');

        //Get Year Dropdown
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
        $currentmonth = date('m');
        $total_rev = 0;
        $revenue = Transaction::select('amount')->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->
        format('Y'))->get();
        foreach ($revenue as $in)
            $total_rev += $in->amount;
        //last month
        $revenue_last = Transaction::whereRaw('MONTH(created_at) = ?', Carbon::now()->subMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();
        $last_rev = 0;
        foreach ($revenue_last as $in)
            $last_rev += $in->amount;

        $revenue = Transaction::whereRaw('MONTH(created_at) = ?', Carbon::now()->startOfMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();
        $current_rev = 0;
        foreach ($revenue as $in)
            $current_rev += $in->amount;

        $change_rev = $current_rev - $last_rev;
        $divide_rev = $change_rev / $last_rev;
        //count percentage revenue
        $percentage_rev = $divide_rev * 100;

        //Total Transaction Current Year
        $year_transaction = Transaction::whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->count();

        //Total Transaction Current Month
        $month_transaction = Transaction::whereRaw('MONTH(created_at) = ?', Carbon::now()->startOfMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->count();
        //last month
        $last_month_transaction = Transaction::whereRaw('MONTH(created_at) = ?', Carbon::now()->subMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->count();

        //Total User
        $user = User::count();

        //Current Average Order Value
        $average_order = $current_rev / $month_transaction;

        //Last Avergae Order Value
        $last_average_order = $last_rev / $last_month_transaction;
        $change_aov = $average_order - $last_average_order;
        $divide_aov = $change_aov / $last_average_order;
        //count percentage aov
        $percentage_aov = $divide_aov * 100;

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
        $count_retention_now = count($new_total) ;

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

        //current customer acqusition
        $acqusition = Transaction::select('user_id')->whereRaw('MONTH(created_at) = ?', Carbon::now()->startOfMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->distinct()->get();
        $acq_now = count($acqusition);

        //customer acqusition last month
        $acqusition = Transaction::select('user_id')->whereRaw('MONTH(created_at) = ?', Carbon::now()->subMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->distinct()->get();
        $acq_last = count($acqusition);

        $divide_acq = ($acq_now-$acq_last) / $acq_last *100;

        //new product
        $product = Product::select()->whereRaw('MONTH(created_at) = ?', Carbon::now()->startOfMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->distinct()->count();

        //

        return view('home', compact('income'))->with('year_array',$year_array)->with('total_rev',$total_rev)
            ->with('percentage_rev', $percentage_rev)->with('current_rev',$current_rev)->with('transaction',$year_transaction)
            ->with('user',$user)->with('average_order',$average_order)->with('percentage_aov',$percentage_aov)->with('count_retention_now',$count_retention_now)
            ->with('count_retention_last',$count_retention_last)->with('percentage_retention',$percentage_retention)->with('divide_acq',$divide_acq)
            ->with('year_now',$year_now)->with('product',$product);
    }

    public function revenue(){

        $revenue_last = Transaction::whereRaw('MONTH(created_at) = ?', Carbon::now()->subMonth()->format('m'))
            ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();
        $last_rev = 0;
        foreach ($revenue_last as $in)
            $last_rev += $in->amount;

        $revenue = Transaction::whereRaw('MONTH(created_at) = ?', Carbon::now()->startOfMonth()->format('m'))
                    ->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();
        $current_rev = 0;
        foreach ($revenue as $in)
            $current_rev += $in->amount;

        $change_rev = $current_rev - $last_rev;
        $divide_rev = $change_rev / $last_rev;
        $percentage_rev = $divide_rev * 100;

        return number_format($percentage_rev, 2);

    }

}
