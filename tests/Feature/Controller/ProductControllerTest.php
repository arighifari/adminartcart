<?php

namespace Tests\Feature\Controller;

use App\Brand;
use App\Categories;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function testExample()
    {
        $cat = Categories::create([
            'title' => 'Kerajinan Tangan',
        ]);
        $cat = Categories::create([
            'title' => 'Anyaman',
        ]);
        $brand = Brand::create([
            'title' => 'ArtCart'
        ]);
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
        Product::create([
            'cat_id' => 1,
            'brand_id' => 1,
            'user_id' => 1,
            'qty' => 2,
            'title' => 'Anyaman Rotan',
            'price' => 50000,
            'description' => 'Anyaman Rotan',
            'image' => 'products/Artcart/anyaman.jpg',
            'keyword' => 'Anyaman Rotan',
            'special' => 0,
            'status' => rand(1,4)
        ]);
        Product::create([
            'cat_id' => 1,
            'brand_id' => 1,
            'user_id' => 1,
            'qty' => 2,
            'title' => 'Anyaman Rotan',
            'price' => 50000,
            'description' => 'Anyaman Rotan',
            'image' => 'products/Artcart/anyaman.jpg',
            'keyword' => 'Anyaman Rotan',
            'special' => 0,
            'status' => rand(1,4)
        ]);
        Product::create([
            'cat_id' => 1,
            'brand_id' => 1,
            'user_id' => 1,
            'qty' => 2,
            'title' => 'Anyaman Rotan',
            'price' => 50000,
            'description' => 'Anyaman Rotan',
            'image' => 'products/Artcart/anyaman.jpg',
            'keyword' => 'Anyaman Rotan',
            'special' => 0,
            'status' => rand(1,4)
        ]);

        $year_now = Carbon::now()->startOfYear()->format('Y');
        //year array
        $year_array = array();
        $posts_dates = Product::orderBy( 'created_at', 'ASC' )->pluck( 'created_at' );
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
        $product = Product::select()->whereMonth('created_at', Carbon::now()->startOfMonth()->format('m'))
            ->whereYear('created_at', Carbon::now()->startOfYear()->format('Y'))->distinct()->count();

        //customer acqusition last month
        $product_last = Product::select()->whereMonth('created_at', Carbon::now()->startOfMonth()->format('m'))
            ->whereMonth('created_at', Carbon::now()->startOfYear()->format('Y'))->distinct()->count();

        if ($product == 0){
            $divide_prod = 0;
        }
        elseif ($product_last == 0){
            $divide_prod = 0;
        }
        else{
            $divide_prod = ($product-$product_last) / $product_last*100;
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
            'product_change' => $result,
            'percentage' => $result2
        );

        //check values of $count_retention_now
        $this->assertEquals(3,$product);
        //check values of percentage
        $this->assertEquals(0,$divide_prod);

        //check array key months in $monthly_post_data_array
        $this->assertArrayHasKey('months',$monthly_post_data_array);
        //check arrat value of $month_name_array
        $this->assertContains('Jan',$month_name_array);
        //check array key post_count_data in $monthly_post_data_array
        $this->assertArrayHasKey('post_count_data',$monthly_post_data_array);
        //check array value of $monthly_post_count_array
        $this->assertContains(3,$monthly_post_count_array);
        //check array key product_change in $revenue_data array
        $this->assertArrayHasKey('product_change',$monthly_post_data_array);
        //check array value of $result
        $this->assertContains(0,$result);
        //check array key percentage in $revenue_data array
        $this->assertArrayHasKey('percentage',$monthly_post_data_array);
        //check array value of $result2
        $this->assertContains(0,$result2);

    }

    function getAllMonths(){
        $month_array = array();
        $posts_dates = Product::orderBy( 'created_at', 'ASC' )->pluck( 'created_at' );
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
        $product = Product::select()->whereMonth( 'created_at', $month )->whereYear('created_at', Carbon::now()->startOfYear()
            ->format('Y'))->distinct()->count();
        return $product;
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
            $monthly_post_count = Product::whereMonth( 'created_at', $month )->count();
        }
        else {
            $monthly_post_count = Product::whereYear('substr(created_at,1,4) ='.$year)->whereMonth( 'created_at', $month )->get()->count();
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
