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
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>Rp. {{number_format($total_rev)}}</h4>

                                <p>Revenue</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                     <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h4>{{$count_retention_now}}</h4>

                          <p>Total Acqusition Now</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h4>{{$count_retention_last}}</h4>

                                <p>Total Acqusitionn last</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h4>65</h4>

                                <p>New Order</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Monthly Recap Report</h5>

                                {{--<div class="card-tools">--}}
                                    {{--<button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
                                        {{--<i class="fas fa-minus"></i>--}}
                                    {{--</button>--}}
                                    {{--<div class="btn-group">--}}
                                        {{--<button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">--}}
                                            {{--<i class="fas fa-wrench"></i>--}}
                                        {{--</button>--}}
                                        {{--<div class="dropdown-menu dropdown-menu-right" role="menu">--}}
                                            {{--<a href="#" class="dropdown-item">Action</a>--}}
                                            {{--<a href="#" class="dropdown-item">Another action</a>--}}
                                            {{--<a href="#" class="dropdown-item">Something else here</a>--}}
                                            {{--<a class="dropdown-divider"></a>--}}
                                            {{--<a href="#" class="dropdown-item">Separated link</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<button type="button" class="btn btn-tool" data-card-widget="remove">--}}
                                        {{--<i class="fas fa-times"></i>--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <p class="text">
                                                    <strong>Sales Chart</strong>
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
                                                                    {{$year}}
                                                                    <option class='common-selector Year' value='{{$year}}'>{{$year}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </div>
                                        </div>
                                        <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                            <canvas id="transaction-Chart" height="180" style="height: 180px;"></canvas>
                                        </div>
                                        <!-- /.chart-responsive -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">
                                        <p class="text-center">
                                            <strong>Goal Completion</strong>
                                        </p>

                                        <div class="progress-group">
                                            Add Products to Cart
                                            <span class="float-right"><b>160</b>/200</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-primary" style="width: 80%"></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->

                                        <div class="progress-group">
                                            Complete Purchase
                                            <span class="float-right"><b>310</b>/400</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-danger" style="width: 75%"></div>
                                            </div>
                                        </div>

                                        <!-- /.progress-group -->
                                        <div class="progress-group">
                                            <span class="progress-text">Visit Premium Page</span>
                                            <span class="float-right"><b>480</b>/800</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" style="width: 60%"></div>
                                            </div>
                                        </div>

                                        <!-- /.progress-group -->
                                        <div class="progress-group">
                                            Send Inquiries
                                            <span class="float-right"><b>250</b>/500</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-warning" style="width: 50%"></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block border-right">
                                            <span class="description-percentage text-success"> @if($percentage_aov >= 0)<i class="fas fa-caret-up"></i> @elseif($percentage_aov == 0) <i class="fas fa-caret-left"></i> @else <i class="fas fa-caret-down"></i> @endif {{number_format($percentage_rev,2)}}%</span>
                                            <h5 class="description-header">Rp. {{number_format($current_rev)}}</h5>
                                            <span class="description-text">TOTAL REVENUE</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block border-right">
                                            <span class="description-percentage text-danger"> @if($percentage_aov >= 0)<i class="fas fa-caret-up"></i> @elseif($percentage_aov == 0) <i class="fas fa-caret-left"></i> @else <i class="fas fa-caret-down"></i> @endif {{number_format($percentage_aov,2)}}%</span>
                                            <h5 class="description-header">Rp. {{number_format($average_order)}}</h5>
                                            <span class="description-text">Average Order Value</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    {{--<!-- /.col -->--}}
                                    {{--<div class="col-sm-3 col-6">--}}
                                        {{--<div class="description-block border-right">--}}
                                            {{--<span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>--}}
                                            {{--<h5 class="description-header">$24,813.53</h5>--}}
                                            {{--<span class="description-text">TOTAL PROFIT</span>--}}
                                        {{--</div>--}}
                                        {{--<!-- /.description-block -->--}}
                                    {{--</div>--}}
                                    {{--<!-- /.col -->--}}
                                    {{--<div class="col-sm-3 col-6">--}}
                                        {{--<div class="description-block">--}}
                                            {{--<span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>--}}
                                            {{--<h5 class="description-header">1200</h5>--}}
                                            {{--<span class="description-text">GOAL COMPLETIONS</span>--}}
                                        {{--</div>--}}
                                        {{--<!-- /.description-block -->--}}
                                    {{--</div>--}}
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </section>
    </div>

    <script src="{{url( 'assets/chart.js/jquery.min.js' )}}"></script>
    <script src="{{url( 'assets/chart.js/Chart.min.js' )}}"></script>
    <script src="{{url( 'assets/dashboard-chart/create-chart.js' )}}"></script>
    <script src="{{url( 'assets/dashboard-chart/year_transaction.js' )}}"></script>

    <script>
        $(document).ready(function(){
            $('#tahun').change(function(){
                var year_filter = $('#tahun').val();
                $.ajax({
                    type: 'GET',
                    url: window.location('/get-post-chart-data/'+year_filter),
                    data: {year_filter:year_filter},
                    success: function(response){
                        $('#transaction-Chart').html(response);
                    }
                })
            })
        });
    </script>
@endsection
