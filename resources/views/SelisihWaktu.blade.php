@extends('layouts.navbar')

@section('sidebar')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Time Delivey Recap Report</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card-header">
                    <h5 class="card-title"></h5>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>{{$selisih1}}</h4>

                                <p>Rata-Rata Waktu Barang Diterima</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>{{$selisih2}}</h4>

                                <p>Rata-Rata Waktu Barang Diproses</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>{{$selisih3}}</h4>

                                <p>Rata-Rata Waktu Barang Dikirim</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>{{$selisih4}}</h4>

                                <p>Rata-Rata Waktu Barang Terkirim</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clock"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
        </section>
    </div>

    <script src="{{url( 'assets/chart.js/jquery.min.js' )}}"></script>
    <script src="{{url( 'assets/chart.js/Chart.min.js' )}}"></script>
    <script src="{{url( 'assets/dashboard-chart/revenue-chart.js' )}}"></script>

@endsection
