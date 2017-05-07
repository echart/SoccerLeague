
$(document).ready(function () {

    // Build the chart
    Highcharts.chart('week', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Do total',
            colorByPoint: true,
            data: [{
                name: 'Receitas',
                y: income
            }, {
                name: 'Despesas',
                y: outcome
            }]
        }]
    });
});
