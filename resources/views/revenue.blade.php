<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="container">
        <!-- Area Chart Example-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Total Transaction </div>
            <div class="card-body">
                <canvas id="transaction-Chart" width="100%" height="30"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header border-0 ">
                <div class="card-body">
                    {{--{{$total}}--}}
                    <canvas class="chartjs-render-monitor" style="display: block; height: 200px; width: 398px;" id="transaction-Chart">

                    </canvas>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script src="{{url( 'assets/chart.js/jquery.min.js' )}}"></script>

<script src="{{url( 'assets/chart.js/Chart.min.js' )}}"></script>

<script src="{{url( 'assets/dashboard-chart/revenue-chart.js' )}}"></script>
