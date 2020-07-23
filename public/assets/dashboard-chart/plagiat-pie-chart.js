( function ( $ ) {
    var charts = {
        init: function () {
            // -- Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;

            this.ajaxGetPostMonthlyData();

        },

        ajaxGetPostMonthlyData: function () {
            var urlPath =  'http://' + window.location.hostname + ':8080' + '/get-plagiat-chart-data';
            var request = $.ajax( {
                method: 'GET',
                url: urlPath
            } );


            request.done( function ( response ) {
                console.log( response );
                charts.createCompletedJobsChart( response );
            });
        },

        /**
         * Created the Completed Jobs Chart
         */
        createCompletedJobsChart: function ( response ) {

            var oilChart = document.getElementById("oilChart");
            //clear old chart data
            // if(window.bar != undefined)
            //     window.bar  .destroy();

            var pieChart = new Chart(oilChart, {
                type: 'pie',
                data: {
                    labels: [
                        "Produk Pending",
                        "Produk Ditolak",
                        "Produk Diterima",
                        "Produk Dibanding",
                        "Produk Banding Ditolak",
                        "Produk Banding Diterima"
                    ],
                    datasets: [
                        {
                            data: response.data,
                            backgroundColor: [
                                "#63FF84",
                                "#FF6384",
                                "#006BB4",
                                "#4A8F52",
                                "#9E0000",
                                "#8463FF"
                            ]
                        }]
                }
             });
        }
    };

    charts.init();


} )( jQuery );

// var oilCanvas = document.getElementById("oilChart");
//
// Chart.defaults.global.defaultFontFamily = "Lato";
// Chart.defaults.global.defaultFontSize = 18;
//
// function data() {
//     var urlPath =  'http://' + window.location.hostname + ':8000' + '/get-plagiat-chart-data';
//     var request = $.ajax( {
//         method: 'GET',
//         url: urlPath
//     } );
//
//
//     request.done( function ( response ) {
//         console.log( response );
//         charts.createCompletedJobsChart( response );
//     });
// }
// var data = JSON.parse('<?php echo $')
// var urlPath =  $.getJSON('http://' + window.location.hostname + ':8000' + '/get-plagiat-chart-data', function(data) {
//     // JSON result in `data` variable
// });
//     // 'http://' + window.location.hostname + ':8000' + '/get-plagiat-chart-data';
// // var parse = JSON.parse(urlPath);
//
// var oilData = {
//     labels: [
//         "Diterima",
//         "Dievaluasi",
//         "Dibanding",
//         "Ditolak"
//     ],
//     datasets: [
//         {
//             data: response,
//             backgroundColor: [
//                 "#FF6384",
//                 "#63FF84",
//                 "#84FF63",
//                 "#8463FF"
//             ]
//         }]
// };
//
// var pieChart = new Chart(oilCanvas, {
//     type: 'pie',
//     data: oilData
// });
