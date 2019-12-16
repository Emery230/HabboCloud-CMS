  $(function(){
    $('.easyPieChart-big').easyPieChart({
        size: 120,
        trackColor: 'rgba(0,0,0,.1)',
        scaleColor: false,
        lineWidth: 8
    });
  
    $("#spark_1").sparkline('html', {
        type: 'line',
        lineColor: '#18C5A9',
        fillColor: '#18C5A9',
        width: '100%',
        height: '50'
    });
    $("#spark_2").sparkline('html', {
        type: 'line',
        lineColor: '#747fa9',
        fillColor: '#747fa9',
        width: '100%',
        height: '50'
    });
  
        
    var lineData = {
        labels: ["W1", "W2", "W3", "W4", "W5", "W6", "W7"],
        datasets: [
            {
                label: "Data 2",
                borderColor: 'rgba(213,217,219, 1)',
                pointBorderColor: "#fff",
                data: [50, 40, 65, 50, 70, 55, 65],
                borderWidth: 4,
                pointBorderWidth: 2,
                fill: false,
                //lineTension: .1
            }
        ]
    };
    var lineOptions = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        scales: {
              xAxes: [{
                  gridLines: {
                      display: false,
                      color: 'rgba(255,255,255,.3)',
                  },
                  ticks: {
                      fontColor: '#eee'
                  }
              }],
              yAxes: [{
                  gridLines: {
                      color: 'rgba(255,255,255,.3)'
                  },
                  ticks: {
                      fontColor: '#eee'
                  }
              }]
        },
    };
    var ctx = document.getElementById("line_chart").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineData, options: lineOptions}); 
  
    var chartdata_1 = {
        labels: ["J", "F", "M", "A", "M", "J", "J", 'A', 'S', 'O', 'N', 'D'],
        datasets: [
            {
                label: "Data 1",
                backgroundColor: '#18C5A9',
                borderColor: "#fff",
                data: [5,6,5,8,3,2,6,7,5,4,9,6]
            }
        ]
    };
    var chartOptions_1 = {
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
    new Chart(ctx, {type: 'bar', data: chartdata_1, options: chartOptions_1});
  
    var chartdata_2 = {
        labels: ['S', "M", "T", "W", "T", "F", "S"],
        datasets: [
            {
                label: "Data 1",
                borderColor: 'rgba(24,197,169,1)',
                backgroundColor: 'rgba(24,197,169,.7)', 
                data: [28, 48, 40, 19, 86, 27, 90],
            }
        ]
    };
    var chartOptions_2 = {
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
                },
                ticks: {
                    display: false,
                    padding: 0,
                },
            }]
        },
        legend: {display: false}
    };
  
    var ctx = document.getElementById("chart_2").getContext("2d");
    new Chart(ctx, {type: 'line', data: chartdata_2, options: chartOptions_2});
  });
