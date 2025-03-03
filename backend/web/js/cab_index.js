// get colors array from the string
function getChartColorsArray(chartId) {
    if (document.getElementById(chartId) !== null) {
        var colors = document.getElementById(chartId).getAttribute("data-colors");
        if (colors) {
            colors = JSON.parse(colors);
            return colors.map(function (value) {
                var newValue = value.replace(" ", "");
                if (newValue.indexOf(",") === -1) {
                    var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                    if (color) return color;
                    else return newValue;;
                } else {
                    var val = value.split(',');
                    if (val.length == 2) {
                        var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                        rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                        return rgbaColor;
                    } else {
                        return newValue;
                    }
                }
            });
        } else {
            console.warn('data-colors Attribute not found on:', chartId);
        }
    }
}

(function ($) {
    $(function () {

$('#ref-link').click(function (e) {
    e.preventDefault();
    navigator.clipboard.writeText($(this).attr('data-copy-text'));
    alert("Copied to clipboard");
});

// Balance Overview charts
var bonusChartsColors = getChartColorsArray("bonus-charts");
if (bonusChartsColors) {

    $.ajax({
        "url": "/cabinet/index-chart",
        "method": "get"
    }).done(function(data) {
        var chartData = JSON.parse(data);
        var options = {
            series: [{
                name: 'Bonuses',
                data: chartData.bonus
            }],
            chart: {
                height: 290,
                type: 'area',
                toolbar: 'false',
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2,
            },
            xaxis: {
                categories: chartData.month
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return "$" + value;
                    }
                },
                tickAmount: 5,
                min: 0,
                max: Math.max.apply(null, chartData.bonus) + 500
            },
            colors: bonusChartsColors,
            fill: {
                opacity: 0.06,
                colors: bonusChartsColors,
                type: 'solid'
            }
        };
        var chart = new ApexCharts(document.querySelector("#bonus-charts"), options);
        chart.render();
    });

}

    })
})(jQuery);
