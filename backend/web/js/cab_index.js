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

// Balance Overview charts
var revenueExpensesChartsColors = getChartColorsArray("revenue-expenses-charts");
if (revenueExpensesChartsColors) {
    var options = {
        series: [{
            name: 'Revenue',
            data: [20, 25, 30, 35, 40, 55, 70, 110, 150, 180, 210, 250]
        }, {
            name: 'Expenses',
            data: [12, 17, 45, 42, 24, 35, 42, 75, 102, 108, 156, 199]
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
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return "$" + value + "k";
                }
            },
            tickAmount: 5,
            min: 0,
            max: 260
        },
        colors: revenueExpensesChartsColors,
        fill: {
            opacity: 0.06,
            colors: revenueExpensesChartsColors,
            type: 'solid'
        }
    };
    var chart = new ApexCharts(document.querySelector("#revenue-expenses-charts"), options);
    chart.render();
}
