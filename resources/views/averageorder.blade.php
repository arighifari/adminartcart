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
                                <h5 class="card-title">Average Order Value Recap Report</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">Rp. {{number_format($averageOrder)}}</h5>
                                                <span class="description-text">Average Order Value</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">{{number_format($percentage_Aov,2)}} %</h5>
                                                <span class="description-text">Percentage Average Order Value</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-footer -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-md-6 col-6">
                                                <p class="text">
                                                    <strong>Average Order Value Chart</strong>
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
                                            <canvas id="aov-Chart" height="120" style="height: 180px;"></canvas>
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
                                            <th>Average Order Value</th>
                                            <th>Average Order Value Change</th>
                                            <th>Percentage Average Order Value Change</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($no=1)
                                        @foreach($data_table['months'] as $key => $data)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$data}}</td>
                                                <td>Rp. {{number_format($data_table['post_count_data'][$key],2)}}</td>
                                                <td>Rp. {{number_format($data_table['aov_change'][$key],2)}}</td>
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
    <script src="{{url( 'assets/dashboard-chart/aov-chart.js' )}}"></script>

@endsection
