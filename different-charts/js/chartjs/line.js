$(function() {
    $.ajax({

        url: 'dbcon.php',
        type: 'GET',
        success: function(data) {
            var chartData = data;
            var chartProperties = {
                "xAxisname": "Month",
                "yAxisName": "Amount (In USD)",
                "numberPrefix": "$",
                "divlineColor": "#999999",
                "divLineIsDashed": "10",
                "divLineDashLen": "10",
                "divLineGapLen": "10",
                "toolTipColor": "#ffffff",
                "toolTipBorderThickness": "0",
                "toolTipBgColor": "#000000",
                "toolTipBgAlpha": "80",
                "toolTipBorderRadius": "2",
                "toolTipPadding": "5",

                "theme": "fusion"
            };

            var apiChart = new FusionCharts({
                type: 'line', /*change this to pie3d to use 3d pie*/
                renderAt: 'chart-container',
                width: '800',
                height: '390',
                dataFormat: 'json',
                dataSource: 
                {
                    "chart": chartProperties,
                    "data": 
                    [       
                        {
                                "label": chartData[0]['label'],
                                "value": chartData[0]['actual_revenue'] 
                        },
                        {
                                "label": chartData[1]['label'],
                                "value": chartData[1]['actual_revenue']
                        },
                        {
                                "label": chartData[2]['label'],
                                "value": chartData[2]['actual_revenue']
                        },
                        {
                                "label": chartData[3]['label'],
                                "value": chartData[3]['actual_revenue']
                        },
                        {
                                "label": chartData[4]['label'],
                                "value": chartData[4]['actual_revenue']
                        },
                        {
                                "label": chartData[5]['label'],
                                "value": chartData[5]['actual_revenue']
                        },
                        {
                                "label": chartData[6]['label'],
                                "value": chartData[6]['actual_revenue']
                        },
                        {
                                "label": chartData[7]['label'],
                                "value": chartData[7]['actual_revenue']
                        },
                        {
                                "label": chartData[8]['label'],
                                "value": chartData[8]['actual_revenue']
                        },
                        {
                                "label": chartData[9]['label'],
                                "value": chartData[9]['actual_revenue']
                        },
                        {
                                "label": chartData[10]['label'],
                                "value": chartData[10]['actual_revenue']
                        },
                        {
                                "label": chartData[11]['label'],
                                "value": chartData[11]['actual_revenue']
                        }                        
                    ],
                    "trendlines": 
                    [
                        {
                            "line": [
                                {
                                    "startvalue": "20000",
                                    "color": "#29C3BE",
                                    "displayvalue": "Average{br}Actual{br}Revenue",
                                    "valueOnRight": "1",
                                    "thickness": "2"
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