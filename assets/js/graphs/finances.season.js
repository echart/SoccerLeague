Highcharts.chart('season', {

    title: {
        text: ''
    },
    yAxis: {
        title: {
            text: 'Dinheiro'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            pointStart: 1
        }
    },
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                yAxis: {
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -5
                    },
                    title: {
                        text: null
                    }
                },
                subtitle: {
                    text: null
                },
                credits: {
                    enabled: false
                }
            }
        }]
    },
    series: [{
        name: 'Temp. Atual',
        data: [4393444, 52503000, 57177, 69658, 97031, 119931, 137133, -10, 40000000]
    }]

});
