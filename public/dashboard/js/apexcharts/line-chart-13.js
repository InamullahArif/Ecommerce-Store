(function ($) {
  
    var tfLineChart = (function () {
  
      var chartBar = function () {
        const keyValuePairs = Object.entries(orders.prices);
        const valuesArray = keyValuePairs.map(([_, value]) => value);
        var options = {
            series: [{
            name: 'Price',
            data:  valuesArray
          }],
            chart: {
            type: 'bar',
            height: 170,
            toolbar: {
              show: false,
            },
          },
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: '3px',
              endingShape: 'rounded'
            },
          },
          dataLabels: {
            enabled: false
          },
          legend: {
            show: false,
          },
          colors: '#B8E1C7',
          stroke: {
            show: false,
          },
          xaxis: {
            labels: {
              show: false
            },
            axisTicks: {
              show: false
            },
            tooltip: {
              enabled: false
            }
          },
          yaxis: {
            show: false,
          },
          fill: {
            opacity: 1
          },
          tooltip: {
            y: {
              formatter: function (val) {
                return "$ " + val
              }
            }
          }
          };

        chart = new ApexCharts(
          document.querySelector("#line-chart-13"),
          options
        );
        if ($("#line-chart-13").length > 0) {
          chart.render();
        }
      };
  
      /* Function ============ */
      return {
        init: function () {},
  
        load: function () {
          chartBar();
        },
        resize: function () {},
      };
    })();
  
    jQuery(document).ready(function () {});
  
    jQuery(window).on("load", function () {
      tfLineChart.load();
    });
  
    jQuery(window).on("resize", function () {});
})(jQuery);