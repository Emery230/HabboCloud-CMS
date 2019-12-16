$(function(){
  
  $('.easyPieChart-big').easyPieChart({
      size: 120,
      trackColor: '#f2f2f2',
      scaleColor: false,
      lineWidth: 8
  });

  // World Map
  var mapData = {
    "US": 7402,
    'RU': 5105,
    "AU": 4700,
    "CN": 4650,
    "FR": 3800,
    "DE": 3780,
    "GB": 2400,
    "SA": 2350,
    "BR": 2270,
    "IN": 1870,
  }
  $('#world-map').vectorMap({
    map: 'world_mill_en',
    backgroundColor: 'transparent',
    regionStyle: {
        initial: {
            fill: '#DADDE0',
        }
    },

    series: {
        regions: [{
            values: mapData,
            scale: ["#18C5A9"],
            normalizeFunction: 'polynomial'
        }]
    },
    onRegionTipShow: function(e, el, code){
        el.html(el.html()+' (Visits - '+mapData[code]+')');
    }
  });

  var chartData = {
      labels: ["S", "M", "T", "W", "T", "F", "S"],
      datasets: [
          {
              label: "Data 1",
              backgroundColor:'#DADDE0',
              data: [45, 80, 58, 74, 54, 59, 40]
          },
          {
              label: "Data 2",
              backgroundColor: '#F39C12',
              borderColor: "#fff",
              data: [29, 48, 40, 19, 78, 31, 85]
          }
      ]
  };
  var chartOptions = {
      responsive: true,
      maintainAspectRatio: false,

      showScale: false,
      scales: {
          xAxes: [{
              gridLines: {
                  display: false,
                  drawBorder: false,
              },
          }],
          yAxes: [{
              gridLines: {
                  display: false,
                  drawBorder: false,
                  drawTicks:false,
                  tickMarkLength: 0
              },
              ticks: {
                  display: false,
                  padding: 0,
              },
          }]
      },
      legend: {display: false}
  };

  var ctx = document.getElementById("chart_1").getContext("2d");
  new Chart(ctx, {type: 'bar', data: chartData, options:chartOptions});



  // Peity charts
  $("span.peity-pie").peity("pie", {
    fill: ['#43AEA8', '#d1d5d8']
  });
  $(".peity-bar").peity("bar", {
    fill: ["#43AEA8", "#d1d5d8"]
  });
  $(".peity-line").peity("line",{
    fill: '#55b6b0',
    stroke:'#3c9c97',
  });


  $("#spark_1").sparkline('html', {
    type: 'line',
    lineColor: '#34495f',
    fillColor: 'transparent',
    width: '100%',
    height: '50'
  });
});
