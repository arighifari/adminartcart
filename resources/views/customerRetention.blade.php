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
                                <h5 class="card-title">Customer Retention Recap Report</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-footer">
                                    <h5  style="text-align: center">Customer Retention This Month</h5>
                                    <div class="row">
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">{{number_format($retention_now)}} Customer</h5>
                                                <span class="description-text">Customer Retention</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">{{number_format($percentage_retention)}} %</h5>
                                                <span class="description-text">Percentage Customer Retention</span>
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
                                                    <strong>Customer Retention Chart</strong>
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
                                            <canvas id="retention-Chart" height="120" style="height: 180px;"></canvas>
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
                                    <h3 style="text-align: center">Customer Retention This Year</h3>
                                    <table class="table table-striped s-0">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Month</th>
                                            <th>Customer Retention</th>
                                            <th>Customer Retention Change</th>
                                            <th>Percentage Customer Retention</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($no=1)
                                        @foreach($data_table['months'] as $key => $data)
                                            <tr class="data_accordion" data-id="{{$no}}">
                                                <td>{{$no}}</td>
                                                <td>{{$data}}</td>
                                                <td>{{$data_table['post_count_data'][$key]}} Customer</td>
                                                <td>{{$data_table['retention_change'][$key]}} Customer</td>
                                                <td>{{number_format($data_table['percentage'][$key],2)}} %</td>
                                            </tr>
                                            <tr class="accordion-hide" id="{{$no}}">
                                                <td colspan="">
                                                    <ul style="list-style: none;">
                                                        @foreach($description[$no-1] as $keys => $val)
                                                            <li>Customer : {{$keys}}</li>
                                                        @endforeach
                                                        {{--@php($no++)--}}
                                                    </ul>
                                                </td>
                                                <td colspan="">
                                                    <ul style="list-style: none;">
                                                        @foreach($description[$no-1] as $keys => $val)
                                                            <li>{{$val}} Kali transaksi</li>
                                                        @endforeach
                                                        @php($no++)
                                                    </ul>
                                                </td>
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
    <script src="{{url( 'assets/dashboard-chart/customerretention-chart.js' )}}"></script>
    <script src="{{url( 'assets/dashboard-chart/year_retention.js' )}}"></script>
    <script>
        $(document).ready(function(){
            $('#tahun').change(function(){
                var year_filter = $('#tahun').val();
                $.ajax({
                    type: 'GET',
                    url: window.location('/get-retention-chart-data/'+year_filter),
                    data: {year_filter:year_filter},
                    success: function(response){
                        $('#retention-Chart').html(response);
                    }
                })
            })
        });

        $(document).ready(function () {
            $('.data_accordion').on('click', function () {
                var id = $(this).data('id');
                var acc = $('#'+id);
                if (acc.hasClass('accordion-show')) {
                    acc.removeClass('accordion-show');
                    acc.addClass('accordion-hide');
                } else {
                    acc.removeClass('accordion-hide');
                    acc.addClass('accordion-show');
                }

            })
        });
        // var acc = document.getElementsByClassName()
    </script>

@endsection
