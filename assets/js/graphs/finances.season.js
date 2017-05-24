data = '';
$.ajax({
  url : '../finances/season',
  method: 'POST',
  dataType: 'JSON',
  data : {},
  success : function(response){
    data = response.data.season;
    $.each(data,function(index,value){
      data[index] = parseInt(value);
    })
    console.log(data);
    graph();
  },
  error : function(response){
    console.log(response);
  }
});
function graph(){
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
          data: data
      }]
  });
}
