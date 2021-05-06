$(function() {
    $.ajax({

        url: 'chart_data.php',
        type: 'GET',
        success: function(data) {
            var chartData = data;
            var chartProperties = {
                "caption": "Top 10 wicket takes ODI Cricket in 2015",
                "bgColor": "#ffffff",
                "startingAngle": "310",
                "showLegend": "1",
                "centerLabelBold": "1",                
                "valuePosition": "inside",
                "minAngleForValue": "75",
                "showPercentValues": "1",
                "showPercentInTooltip": "0",
                "theme": "fusion",
                "showXAxisLine": "1",
                "axisLineAlpha": "25",
                "showHoverEffect": "1"
            };

            var apiChart = new FusionCharts({
                type: 'pie2d', /*change this to pie3d to use 3d pie*/
                renderAt: 'chart-container',
                width: '550',
                height: '350',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": chartData
                }
            }
            );
            apiChart.render();
        }
    });
});