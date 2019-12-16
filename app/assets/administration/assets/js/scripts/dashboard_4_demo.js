$(function(){
  
    $('.easyPieChart-big').easyPieChart({
        size: 120,
        trackColor: '#f2f2f2',
        scaleColor: false,
        lineWidth: 8
    });
      
    // Bar Chart example
    ////////////////////

    var barData = {
        labels: ["W1", "W2", "W3", "W4", "W5", "W6", "W7"],
        datasets: [
            {
                label: "Data 1",
                borderColor: 'rgba(24,197,169,0.7)',
                pointBackgroundColor: 'rgba(24,197,169,1)',
                pointBorderColor: "#fff",
                data: [28, 48, 40, 19, 86, 27, 90],
                borderWidth: 4,
                pointBorderWidth: 2,
                fill: false,
            },{
                label: "Data 2",
                borderColor: 'rgba(213,217,219, 1)',
                pointBorderColor: "#fff",
                data: [65, 59, 80, 81, 56, 55, 40],
                borderWidth: 4,
                pointBorderWidth: 2,
                fill: false,
            }
        ]
    };
    var barOptions = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        scales: {
              xAxes: [{
                  gridLines: {
                      display: false,
                      drawBorder: false,
                  },
              }],
              yAxes: [{
                  gridLines: {
                      drawBorder: false,
                  },
              }]
        },
    };

    var ctx = document.getElementById("line_chart").getContext("2d");
    new Chart(ctx, {type: 'line', data: barData, options:barOptions}); 
    
    var chartdata_2 = {
        labels: ["J", "F", "M", "A", "M", "J", "J", 'A', 'S', 'O', 'N', 'D'],
        datasets: [
            {
                label: "Data 1",
                borderColor: 'rgba(24,197,169,1)',
                backgroundColor: 'rgba(24,197,169,.7)', 
                data: [5,6,5,8,3,2,6,7,5,4,9,6]
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
    new Chart(ctx, {type: 'bar', data: chartdata_2, options: chartOptions_2});

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
});
