$(function() {
    $.ajax({

        url: 'dbcon.php',
        type: 'GET',
        success: function(data) {
            var chartData = data;
            var chartProperties = {
                "theme": "fusion",
                "caption": "Comparison of Quarterly Revenue",
                "xAxisname": "Quarter",
                "yAxisName": "Revenues (In USD)",
                "numberPrefix": "$",
                "plotFillAlpha": "80",
                "divLineIsDashed": "1",
                "divLineDashLen": "1",
                "divLineGapLen": "1",
                "showXAxisLine": "1",
                "axisLineAlpha": "25",
                "showHoverEffect": "1"
            };

            var apiChart = new FusionCharts({
                type: 'mscolumn3d', /*change this to pie3d to use 3d pie*/
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
                    ],
                    "trendlines": [{
                        "line": [{
                            "startvalue": "12250",
                            "color": "#5D62B5",
                            "displayvalue": "Previous{br}Average",
                            "valueOnRight": "1",
                            "thickness": "1",
                            "showBelow": "1",
                            "tooltext": "Previous year quarterly target  : $13.5K"
                        }, {
                            "startvalue": "25950",
                            "color": "#29C3BE",
                            "displayvalue": "Current{br}Average",
                            "valueOnRight": "1",
                            "thickness": "1",
                            "showBelow": "1",
                            "tooltext": "Current year quarterly target  : $23K"
                        }]
                    }]
                }
            });
            apiChart.render();
        }
    });
});