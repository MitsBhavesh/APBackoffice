function getChartColorsArray(e) {
    e = $(e).attr("data-colors");
    return (e = JSON.parse(e)).map(function(e) {
        e = e.replace(" ", "");
        if (-1 == e.indexOf("--")) return e;
        e = getComputedStyle(document.documentElement).getPropertyValue(e);
        return e || void 0
    })
}
var pieColors = getChartColorsArray("#pie-chart"),
    dom = document.getElementById("pie-chart"),
    myChart = echarts.init(dom),
    app = {};
option = null, option = {
    tooltip: {
        trigger: "item",
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: "vertical",
        left: "left",
        data: ["Active Client", "Inactive Client", "Non-trade", "Last How Much trade"],
        textStyle: {
            color: "#858d98"
        }
    },
    color: pieColors,
    series: [{
        name: "Total Client",
        type: "pie",
        radius: "55%",
        center: ["50%", "60%"],
        data: [{
            value: 335,
            name: "Active Client"
        }, {
            value: 310,
            name: "Inactive Client"
        }, {
            value: 234,
            name: "Non-trade"
        }, {
            value: 135,
            name: "Last How Much trade"
        }],
        itemStyle: {
            emphasis: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: "rgba(0, 0, 0, 0.5)"
            }
        }
    }]
},  setInterval(function() {
    option.series[0].data[0].value = +(100 * Math.random()).toFixed(2), myChart.setOption(option, !0)
}, 2e3), option && "object" == typeof option && myChart.setOption(option, !0);