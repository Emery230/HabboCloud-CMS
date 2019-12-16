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
      labels: ["Sunday", "Munday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
      datasets: [
          {
              label: "Data 1",
              backgroundColor:'#DADDE0', //'rgba(220, 220, 220, 0.5)',
              data: [45, 80, 58, 74, 54, 59, 40]
          },
          {
              label: "Data 2",
              //backgroundColor:'#84cac6',// 'rgba(26,179,148,0.5)',
              backgroundColor: '#18C5A9', // '#30C8B3'
              borderColor: "#fff",
              data: [29, 48, 40, 19, 78, 31, 85]
          }
      ]
  };
  var barOptions = {
      responsive: true,
      maintainAspectRatio: false
  };
  
  var ctx = document.getElementById("bar_chart").getContext("2d");
  new Chart(ctx, {type: 'bar', data: barData, options:barOptions}); 
});
