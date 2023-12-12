window.onload = function () {

      var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
                  text: "Reservations"
            },
            axisX:{
                  valueFormatString: "MMM YYYY",
                  crosshair: {
                        enabled: true,
                        snapToDataPoint: true
                  }
            },
            axisY: {
                  title: "Number of reservations",
                  includeZero: true,
                  crosshair: {
                        enabled: true
                  }
            },
            toolTip:{
                  shared:true
            },  
            legend:{
                  cursor:"pointer",
                  verticalAlign: "bottom",
                  horizontalAlign: "left",
                  dockInsidePlotArea: true,
                  itemclick: toogleDataSeries
            },
            data: [{
                  type: "line",
                  showInLegend: true,
                  name: "Normal Nets",
                  markerType: "square",
                  xValueFormatString: "MMMM, YYYY",
                  color: "#F08080",
                  dataPoints: [
                        { x: new Date(2017, 0), y: 70 },
                        { x: new Date(2017, 1), y: 63 },
                        { x: new Date(2017, 2), y: 71 },
                        { x: new Date(2017, 3), y: 65 },
                        { x: new Date(2017, 4), y: 73 },
                        { x: new Date(2017, 5), y: 96 },
                        { x: new Date(2017, 6), y: 84 },
                        { x: new Date(2017, 7), y: 43 },
                        { x: new Date(2017, 8), y: 86 },
                        { x: new Date(2017, 9), y: 93 },
                        { x: new Date(2017, 10), y: 85 },
                        { x: new Date(2017, 11), y: 90 },
                        { x: new Date(2017, 12), y: 91 }
                  ]
            },
            {
                  type: "line",
                  showInLegend: true,
                  name: "Machine Nets",
                  lineDashType: "solid",
                  color: "#57d0a0",
                  dataPoints: [
                        { x: new Date(2017, 0), y: 12 },
                        { x: new Date(2017, 1), y: 18 },
                        { x: new Date(2017, 2), y: 23 },
                        { x: new Date(2017, 3), y: 15 },
                        { x: new Date(2017, 4), y: 7 },
                        { x: new Date(2017, 5), y: 19 },
                        { x: new Date(2017, 6), y: 28 },
                        { x: new Date(2017, 7), y: 25 },
                        { x: new Date(2017, 8), y: 18 },
                        { x: new Date(2017, 9), y: 16 },
                        { x: new Date(2017, 10), y: 32 },
                        { x: new Date(2017, 11), y: 9 },
                        { x: new Date(2017, 12), y: 36}
                  ]
            }]
      });
      chart.render();
      
      function toogleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                  e.dataSeries.visible = false;
            } else{
                  e.dataSeries.visible = true;
            }
            chart.render();
      }
      
      }