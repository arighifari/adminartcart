<?php

namespace App\Http\Controllers;

use App\Order;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function dashboard(){
        $transaction = Order::count();
        $user = User::count();

        return view ('dashboard',compact('transaction','user'));
    }

    public function home(){

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
        $revenue = Transaction::select('amount')->whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->get();
        foreach ($revenue as $in)
            $total_rev += $in->amount;
        //
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

        //Total Transaction Current Year
        $transaction = Transaction::whereRAW('YEAR(created_at) = ?', Carbon::now()->startOfYear()->format('Y'))->count();

        //Total User
        $user = User::count();

        return view('home', compact('income'))->with('year_array',$year_array)->with('total_rev',$total_rev)
            ->with('percentage_rev', $percentage_rev)->with('current_rev',$current_rev)->with('transaction',$transaction)
            ->with('user',$user);
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
