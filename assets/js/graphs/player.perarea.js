Highcharts.chart('container', {

    chart: {
        polar: true,
        type: 'line'
    },

    title: {
        text: 'Skills',
        x: -80
    },

    pane: {
        size: '80%'
    },

    xAxis: {
        categories: ['Fisico','técnico','psicologico'],
        tickmarkPlacement: 'on',
        lineWidth: 0
    },

    yAxis: {
        gridLineInterpolation: 'polygon',
        lineWidth: 0,
        min: 0
    },

    tooltip: {
        shared: true,
        pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
    },

    legend: {
        align: 'right',
        verticalAlign: 'top',
        y: 70,
        layout: 'vertical'
    },

    series: [{
        name: 'Total na área',
        data: [physical, technical, psychologic],
        pointPlacement: 'on'
    }]

});
