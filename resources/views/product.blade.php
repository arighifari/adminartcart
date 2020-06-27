@extends('layouts.navbar')

@section('sidebar')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Product Recap Report</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">{{$product}} Product</h5>
                                                <span class="description-text">New Product This Month</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">{{$percentage_prod}} %</h5>
                                                <span class="description-text">Percentage Product Change</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        {{--<div class="col-sm-3 col-6">--}}
                                            {{--<div class="description-block border-right">--}}
                                                {{--<h5 class="description-header">{{number_format($percentage_rev,2)}} %</h5>--}}
                                                {{--<span class="description-text">Revenue Percent Change</span>--}}
                                            {{--</div>--}}
                                            {{--<!-- /.description-block -->--}}
                                        {{--</div>--}}
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-footer -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-md-6 col-6">
                                                <p class="text">
                                                    <strong>Revenue Chart</strong>
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <p class="text">
                                                                <strong>Select Year :</strong>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <select class="custom-select custom-select-sm" style="margin-bottom: 12px" name="section" id="tahun">
                                                                <option  value=''>Tahun</option>
                                                                @foreach($year_array as $year)
                                                                    <option class='common-selector Year' @if($year == $year_now) selected @endif value='{{$year}}'>{{$year}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </div>
                                        </div>
                                        <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                            <canvas id="product-Chart" height="120" style="height: 180px;"></canvas>
                                        </div>
                                        <!-- /.chart-responsive -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- /.card-header -->
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table s-0">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Month</th>
                                            <th>Product</th>
                                            <th>Product Change</th>
                                            <th>Percentage Product Change</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($no=1)
                                        {{--@foreach(array_combine($data_table['months'] , $month_data) as $key => $data )--}}
                                        {{--<tr>--}}
                                        {{--<td>{{$no++}}</td>--}}
                                        {{--<td>{{$key}}</td>--}}
                                        {{--<td>{{$data['post_count_data'][$key]}}</td>--}}
                                        {{--<td>a</td>--}}
                                        {{--<td>{{$data}}</td>--}}
                                        {{--<td>{{$key['post_count_data']}}</td>--}}
                                        {{--</tr>--}}
                                        {{--@endforeach--}}
                                        @foreach($data_table['months'] as $key => $data)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$data}}</td>
                                                <td>{{$data_table['post_count_data'][$key]}} Product</td>
                                                <td>{{$data_table['product_change'][$key]}}</td>
                                                <td>{{number_format($data_table['percentage'][$key],2)}} %</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{url( 'assets/chart.js/jquery.min.js' )}}"></script>
    <script src="{{url( 'assets/chart.js/Chart.min.js' )}}"></script>
    <script src="{{url( 'assets/dashboard-chart/product-chart.js' )}}"></script>

@endsection
