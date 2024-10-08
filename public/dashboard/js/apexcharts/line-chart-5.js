(function ($) {
    
    var tfLineChart = (function () {
  
      var chartBar = function () {
        const keyValuePairs = Object.entries(orders.monthly_orders);
        const valuesArray = keyValuePairs.map(([_, value]) => value);
        var options = {
            chart: {
              height: 291,
              type: "area",
              zoom: {
                enabled: false
              },
              toolbar: {
                show: false,
              },
            },
            dataLabels: {
              enabled: false
            },
            colors: ["#2275fc"],
            series: [
              {
                name: "$",
                data: valuesArray,
              }
            ],
            fill: {
              type: "gradient",
              gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.3,
                opacityTo: 0.9,
                stops: [0, 90, 100]
              }
            },
            yaxis: {
              show: false,
            },
            xaxis: {
              labels: {
                style: {
                  colors: '#95989D',
                },
              },
              categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
              ]
            }
          };

        chart = new ApexCharts(
          document.querySelector("#line-chart-5"),
          options
        );
        if ($("#line-chart-5").length > 0) {
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