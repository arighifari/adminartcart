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
            {{--@foreach($year_array as $year)--}}
                {{--{{$year}}--}}
                {{--@endforeach--}}
            <select class="custom-select custom-select-sm" style="margin-left: 3px" name="section" id="tahun">
                <option  value=''>Tahun</option>
                @foreach($year_array as $year)
                    {{$year}}
                <option class='common-selector Year' value='{{$year}}'>{{$year}}</option>
                @endforeach
            </select>
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

<script src="{{url( 'transaction-chart.jsrt.js' )}}"></script>

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

