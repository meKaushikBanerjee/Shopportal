$(function() {
    $.ajax({

        url: 'chart_data.php',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "Top 10 wicket takes ODI Cricket in 2015",
                "xAxisName": "Player",
                "yAxisName": "Wickets Taken",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'column3d',
                renderAt: 'chart-container',
                width: '750',
                height: '350',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": chartData,
                    "trendlines": [
                        {
                            "line": [
                                {
                                    "startvalue": "700000",
                                    "valueOnRight": "1",
                                    "displayvalue": "Monthly Target"
                                }
                            ]
                        }
                    ]
                }
            });
            apiChart.render();
        }
    });
});