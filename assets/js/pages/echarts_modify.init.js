
function getChartColorsArray(e) {
    e = $(e).attr("data-colors");
    return (e = JSON.parse(e)).map(function(e) {
        e = e.replace(" ", "");
        if (-1 == e.indexOf("--")) return e;
        e = getComputedStyle(document.documentElement).getPropertyValue(e);
        return e || void 0
    })
}
var base_url = window.location.origin;
// alert(base_url)
$.ajax({
    type: "POST",
    url: base_url+"/Dashboard/Total_client",
    cache: false,
    success:function(result) {
       // alert(result);
       var Total_client = result;
       localStorage.setItem('Total_client', Total_client);
   }
    

});
var Total_client =localStorage.getItem('Total_client'); 

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
        data: ["Total Client", "Non-Trade Client", "Traded Client"],
        textStyle: {
            color: "#858d91"
        }
    },
    color: pieColors,
    series: [{
        name: "Client Overview [ON Working]",
        type: "pie",
        radius: "55%",
        center: ["50%", "60%"],
        data: [
        {
            value: Total_client,
            name: "Total Client"
        }, {
            value: 1,
            name: "Non-Trade Client"
        }, {
            value: 1,
            name: "Traded Client"
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
    
    // option.series[0].data[0].value = +(100 * Math.random()).toFixed(2), myChart.setOption(option, !0)
}, 2e3), option && "object" == typeof option && myChart.setOption(option, !0);

$("#client_overview").change(function () {                            
   var client_overview= $("#client_overview").val() // Here we can get the value of selected item
   $("#month_wise").html(client_overview);
});
