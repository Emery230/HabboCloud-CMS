$(function(){
  $('.ease-pie').easyPieChart({
      size: 60,
      trackColor: '#f2f2f2',
      scaleColor: false
  });

  $("#spark_bar_big").sparkline('html', {
      type: 'bar',
      height: '40px',
      barWidth: 7,
      barColor: '#18C5A9',
      negBarColor: '#bdc3c7',  // for negative values
      stackedBarColor: ['#43AEA8','#bdc3c7'], // for stacked bar
  });



  // Line Chart example
  ////////////////////
  var lineData = {
      labels: ["W1", "W2", "W3", "W4", "W5", "W6", "W7", "W8", "W9", "W10"],
      datasets: [
          {
              label: "Data 1",
              borderColor: 'rgba(24,197,169,0.7)',
              backgroundColor: 'rgba(24,197,169,0.5)',
              pointBackgroundColor: 'rgba(24,197,169,1)',
              //backgroundColor: 'rgba(67,174,168,0.5)',
              //borderColor: 'rgba(67,174,168,0.7)',
              //pointBackgroundColor: 'rgba(67,174,168,1)',
              pointBorderColor: "#fff",
              data: [28, 48, 40, 19, 86, 27, 32, 67, 32, 22],
          },{
              label: "Data 2",
              backgroundColor: 'rgba(213,217,219, 0.5)',
              borderColor: 'rgba(213,217,219, 1)',
              pointBorderColor: "#fff",
              data: [35, 32, 70, 40, 56, 55, 40, 37, 48, 30],
          }
      ],
  };
  var lineOptions = {
      responsive: true,
      maintainAspectRatio: false,

      showScale: false,
      scales: {
          xAxes: [{
              gridLines: {
                  display: false,
              },
          }],
          yAxes: [{
              gridLines: {
                  display: false,
                  drawBorder: false,
              },
          }]
      },
      legend: {display: false}
  };
  var ctx = document.getElementById("line_chart").getContext("2d");
  new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});
});
