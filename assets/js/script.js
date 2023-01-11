// ---------- CHARTS ---------- //
// BAR CHART //
var barChartOptions = {
    series: [{
      data: [22,11 , 6, 4]
    }],
    chart: {
      type: 'bar',
      height: 350,
      toolbar: {
        show: false
      },
    },
    colors: [
      "#246dec",
      "#f5b74f",
      "#cc3c43",
      "#367952",
    ],
    plotOptions: {
      bar: {
        distributed: true,
        borderRadius: 4,
        horizontal: false,
        columnWidth: '40%',
      }
    },
    dataLabels: {
      enabled: false
    },
    legend: {
      show: false
    },
    xaxis: {
      categories: ["New", "Pending", "Overdue", "Comprgeehgrgrrgleted"],
    },
    yaxis: {
      title: {
        text: "Number of Maintenance Works"
      }
    }
  };
  
  var barChart = new ApexCharts(document.querySelector("#bar-chart"), barChartOptions);
  barChart.render();


// AREA CHART //

var areaChartOptions = {
    series: [{
       name: 'Last Year Maintenance Works',
       data: [31, 40, 28, 51, 42, 109, 100, 99, 100, 22, 21, 99]
     }],
     chart: {
       height: 350,
       type: 'area',
       toolbar: {
         show: false,
       },
     },
     colors: ["#4f35a1"],
     dataLabels: {
       enabled: false,
     },
     stroke: {
       curve: 'smooth'
     },
     labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec",],
     markers: {
       size: 0
     },
     yaxis: [
       {
         title: {
           text: 'Total Number of Works',
         },
       },
     ],
     tooltip: {
       shared: true,
       intersect: false,
     }
   };
   
   var areaChart = new ApexCharts(document.querySelector("#area-chart"), areaChartOptions);
   areaChart.render();