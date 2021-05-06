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
                "divLineIsDashed": "1",
                "divLineDashLen": "1",
                "divLineGapLen": "1",
                "toolTipColor": "#ffffff",
                "toolTipBorderThickness": "0",
                "toolTipBgColor": "#000000",
                "toolTipBgAlpha": "80",
                "toolTipBorderRadius": "2",
                "toolTipPadding": "5",
                "showHoverEffect": "1",
                "theme": "zane"
            };

            var apiChart = new FusionCharts({
                type: 'mscombi3d', /*change this to pie3d to use 3d pie*/
                renderAt: 'chart-container',
                width: '100%',
                height: '390',
                dataFormat: 'json',
                dataSource: 
                {
                    "chart": chartProperties,
                    "categories": 
                    [{
                        "category": 
                        [ 
                            {
                                "label": chartData[0]['label']
                            },
                            {
                                "label": chartData[1]['label']
                            },
                            {
                                "label": chartData[2]['label']
                            },
                            {
                                "label": chartData[3]['label']
                            },
                            {
                                "label": chartData[4]['label']
                            },
                            {
                                "label": chartData[5]['label']
                            },
                            {
                                "label": chartData[6]['label']
                            },
                            {
                                "label": chartData[7]['label']
                            },
                            {
                                "label": chartData[8]['label']
                            },
                            {
                                "label": chartData[9]['label']
                            },
                            {
                                "label": chartData[10]['label']
                            },
                            {
                                "label": chartData[11]['label']
                            }
                        ]
                    }],
                    "dataset": 
                    [
                        {                            
                            "seriesName": "Actual Revenue",
                            "showValues": "1",
                            "data": 
                            [
                                {
                                    "value": chartData[0]['actual_revenue']
                                },
                                {
                                    "value": chartData[1]['actual_revenue']
                                },
                                {
                                    "value": chartData[2]['actual_revenue']
                                },
                                {
                                    "value": chartData[3]['actual_revenue']
                                },
                                {
                                    "value": chartData[4]['actual_revenue']
                                },
                                {
                                    "value": chartData[5]['actual_revenue']
                                },
                                {
                                    "value": chartData[6]['actual_revenue']
                                },
                                {
                                    "value": chartData[7]['actual_revenue']
                                },
                                {
                                    "value": chartData[8]['actual_revenue']
                                },
                                {
                                    "value": chartData[9]['actual_revenue']
                                },
                                {
                                    "value": chartData[10]['actual_revenue']
                                },
                                {
                                    "value": chartData[11]['actual_revenue']
                                }
                            ]
                        },
                        {
                            "seriesName": "Projected Revenue",
                            "renderAs": "line",
                            "data": 
                            [
                                {
                                    "value": chartData[0]['projected_revenue']
                                },
                                {
                                    "value": chartData[1]['projected_revenue']
                                },
                                {
                                    "value": chartData[2]['projected_revenue']
                                },
                                {
                                    "value": chartData[3]['projected_revenue']
                                },
                                {
                                    "value": chartData[4]['projected_revenue']
                                },
                                {
                                    "value": chartData[5]['projected_revenue']
                                },
                                {
                                    "value": chartData[6]['projected_revenue']
                                },
                                {
                                    "value": chartData[7]['projected_revenue']
                                },
                                {
                                    "value": chartData[8]['projected_revenue']
                                },
                                {
                                    "value": chartData[9]['projected_revenue']
                                },
                                {
                                    "value": chartData[10]['projected_revenue']
                                },
                                {
                                    "value": chartData[11]['projected_revenue']
                                }
                            ]
                        },
                        {
                            "seriesName": "Profit",
                            "renderAs": "area",
                            "data": 
                            [
                                {
                                    "value": chartData[0]['profit']
                                },
                                {
                                    "value": chartData[1]['profit']
                                },
                                {
                                    "value": chartData[2]['profit']
                                },
                                {
                                    "value": chartData[3]['profit']
                                },
                                {
                                    "value": chartData[4]['profit']
                                },
                                {
                                    "value": chartData[5]['profit']
                                },
                                {
                                    "value": chartData[6]['profit']
                                },
                                {
                                    "value": chartData[7]['profit']
                                },
                                {
                                    "value": chartData[8]['profit']
                                },
                                {
                                    "value": chartData[9]['profit']
                                },
                                {
                                    "value": chartData[10]['profit']
                                },
                                {
                                    "value": chartData[11]['profit']
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