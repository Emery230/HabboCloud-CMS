$(function(){

    var barData = {
        labels: ["S", "M", "T", "W", "T", "F", "S"],
        datasets: [
            {
                label: "Data 1",
                backgroundColor: '#2CC4CB', // '#30C8B3'
                borderColor: "#fff",
                data: [29, 48, 40, 19, 78, 31, 85]
            }
        ]
    };
    var barOptions = {
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
    new Chart(ctx, {type: 'bar', data: barData, options:barOptions});

    var data2 = {
        labels: ["W1", "W2", "W3", "W4", "W5", "W6", "W7"],
        datasets: [
            {
                label: "Data 1",
                borderColor: 'rgba(243,156,18,0.7)',
                pointBackgroundColor: 'rgba(243,156,18,1)',
                pointBorderColor: "#fff",
                data: [28, 48, 40, 19, 86, 27, 90],
                borderWidth: 3,
                pointBorderWidth: 2,
                fill: false,
            }
        ]
    };
    var options2 = {
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
    var ctx = document.getElementById("chart_2").getContext("2d");
    new Chart(ctx, {type: 'line', data: data2, options:options2});

    var data3 = {
        labels: ["W1", "W2", "W3", "W4", "W5", "W6", "W7"],
        datasets: [
            {
                label: "Data 1",
                borderColor: 'rgba(24,197,169,0.7)',
                backgroundColor: 'rgba(24,197,169,0.5)',
                pointBackgroundColor: 'rgba(24,197,169,1)',
                pointBorderColor: "#fff",
                data: [28, 48, 40, 19, 86, 27, 90],
                borderWidth: 3,
                pointBorderWidth: 2,
                //fill: true,
            }
        ]
    };
    var options3 = {
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
    var ctx = document.getElementById("chart_3").getContext("2d");
    new Chart(ctx, {type: 'line', data: data3, options:options3});


    var data4 = {
        labels: ["S", "M", "T", "W", "T", "F", "S"],
        datasets: [
            {
                label: "Data 1",
                backgroundColor:'#DADDE0', //'rgba(220, 220, 220, 0.5)',
                data: [45, 80, 58, 74, 54, 59, 40]
            },
            {
                label: "Data 2",
                backgroundColor: '#18C5A9', // '#30C8B3'
                borderColor: "#fff",
                data: [29, 48, 40, 19, 78, 31, 85]
            }
        ]
    };
    var options4 = {
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

    var ctx = document.getElementById("chart_4").getContext("2d");
    new Chart(ctx, {type: 'bar', data: data4, options:options4});


    var chartdata_5 = {
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
    var chartOptions_5 = {
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

    var ctx = document.getElementById("chart_5").getContext("2d");
    new Chart(ctx, {type: 'bar', data: chartdata_5, options: chartOptions_5});


    $('.easyPieChart-big').easyPieChart({
        size: 120,
        trackColor: '#f2f2f2',
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
    $("#spark_4").sparkline('html', {
        type: 'line',
        lineColor: '#F39C12',
        fillColor: '#F39C12',
        width: '100%',
        height: '50'
    });
    $("#spark_5").sparkline('html', {
        type: 'line',
        lineColor: '#34495f',
        fillColor: 'transparent',
        width: '100%',
        height: '50'
    });
    $("#spark_6").sparkline('html', {
        type: 'line',
        lineColor: '#fff',
        fillColor: 'transparent',
        width: '100%',
        height: '50'
    });
    $("#spark_8").sparkline('html', {
        type: 'line',
        lineColor: '#fff',
        fillColor: '#ebedee',
        width: '100%',
        height: '50'
    });


    (function drawMouseSpeedDemo() {
        var mrefreshinterval = 500; // update display every 500ms
        var lastmousex=-1; 
        var lastmousey=-1;
        var lastmousetime;
        var mousetravel = 0;
        var mpoints = [];
        var mpoints_max = 30;
        $('html').mousemove(function(e) {
            var mousex = e.pageX;
            var mousey = e.pageY;
            if (lastmousex > -1) {
                mousetravel += Math.max( Math.abs(mousex-lastmousex), Math.abs(mousey-lastmousey) );
            }
            lastmousex = mousex;
            lastmousey = mousey;
        });
        var mdraw = function() {
            var md = new Date();
            var timenow = md.getTime();
            if (lastmousetime && lastmousetime!=timenow) {
                var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
                mpoints.push(pps);
                if (mpoints.length > mpoints_max)
                    mpoints.splice(0,1);
                mousetravel = 0;
                $('#spark_3').sparkline(mpoints, { 
                  width: mpoints.length*2, 
                  lineColor: '#18C5A9', 
                  width: '100%',
                  height: '50',
                  tooltipSuffix: ' pixels per second' 
                });
            }
            lastmousetime = timenow;
            setTimeout(mdraw, mrefreshinterval);
        }
        // We could use setInterval instead, but I prefer to do it this way
        setTimeout(mdraw, mrefreshinterval); 
    })();

    (function drawMouseSpeedDemo() {
        var mrefreshinterval = 500; // update display every 500ms
        var lastmousex=-1; 
        var lastmousey=-1;
        var lastmousetime;
        var mousetravel = 0;
        var mpoints = [];
        var mpoints_max = 30;
        $('html').mousemove(function(e) {
            var mousex = e.pageX;
            var mousey = e.pageY;
            if (lastmousex > -1) {
                mousetravel += Math.max( Math.abs(mousex-lastmousex), Math.abs(mousey-lastmousey) );
            }
            lastmousex = mousex;
            lastmousey = mousey;
        });
        var mdraw = function() {
            var md = new Date();
            var timenow = md.getTime();
            if (lastmousetime && lastmousetime!=timenow) {
                var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
                mpoints.push(pps);
                if (mpoints.length > mpoints_max)
                    mpoints.splice(0,1);
                mousetravel = 0;
                $('#spark_7').sparkline(mpoints, { 
                  width: mpoints.length*2, 
                  lineColor: '#fff',
                  fillColor: 'transparent', 
                  width: '100%',
                  height: '50',
                  tooltipSuffix: ' pixels per second' 
                });
            }
            lastmousetime = timenow;
            setTimeout(mdraw, mrefreshinterval);
        }
        // We could use setInterval instead, but I prefer to do it this way
        setTimeout(mdraw, mrefreshinterval); 
    })();

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
  
})