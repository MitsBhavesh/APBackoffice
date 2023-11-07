$.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/year",
             cache: false,
             success:function(result) {
                localStorage.removeItem("year");
                localStorage.setItem('year', result)
            }

       });
$.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/monthWise_Jan",
             cache: false,
             success:function(result) {
                localStorage.removeItem("Jan");
                var Brokerage_earn = result;
                localStorage.setItem('Jan', Brokerage_earn)
            }

       });
 $.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/monthWise_Feb",
             cache: false,
             success:function(result) {
                // alert(result);
                localStorage.removeItem("Feb");
                    var Brokerage_earn = result;
                localStorage.setItem('Feb', Brokerage_earn)
            }

       });
 $.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/monthWise_March",
             cache: false,
             success:function(result) {
                // alert(result);
                localStorage.removeItem("March");
                     var Brokerage_earn = result;
                localStorage.setItem('March', Brokerage_earn)
            }

       });
 $.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/monthWise_April",
             cache: false,
             success:function(result) {
localStorage.removeItem("April");
                     var Brokerage_earn = result;
                localStorage.setItem('April', Brokerage_earn)
            }

       });
 $.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/monthWise_May",
             cache: false,
             success:function(result) {
localStorage.removeItem("May");
                   var Brokerage_earn = result;
                localStorage.setItem('May', Brokerage_earn)
            }

       });
 $.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/monthWise_June",
             cache: false,
             success:function(result) {
localStorage.removeItem("June");
                    var Brokerage_earn = result;
                localStorage.setItem('June', Brokerage_earn)
            }

       });
 $.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/monthWise_July",
             cache: false,
             success:function(result) {
localStorage.removeItem("July");
                    var Brokerage_earn = result;
                localStorage.setItem('July', Brokerage_earn)
            }

       });
  $.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/monthWise_August",
             cache: false,
             success:function(result) {
localStorage.removeItem("August");
                      var Brokerage_earn = result;
                localStorage.setItem('August', Brokerage_earn)
            }

       });
  $.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/monthWise_September",
             cache: false,
             success:function(result) {
localStorage.removeItem("September");
                         var Brokerage_earn = result;
                localStorage.setItem('September', Brokerage_earn)
            }

       });
  $.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/monthWise_Octomber",
             cache: false,
             success:function(result) {
localStorage.removeItem("October");
                       var Brokerage_earn = result;
                localStorage.setItem('October', Brokerage_earn)
            }

       });
  $.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/monthWise_November",
             cache: false,
             success:function(result) {

                localStorage.removeItem('November');
                var Brokerage_earn = result;
                localStorage.setItem('November', Brokerage_earn)
            }

       });
  $.ajax({
             type: "POST",
             url: "https://apoffice.arhamshare.com/Dashboard/monthWise_December",
             cache: false,
             success:function(result) {
                    localStorage.removeItem("December");
                        var Brokerage_earn = result;
                localStorage.setItem('December', Brokerage_earn)
            }

       });
function getChartColorsArray(r) {
    r = $(r).attr("data-colors");
    return (r = JSON.parse(r)).map(function(r) {
        r = r.replace(" ", "");
        if (-1 == r.indexOf("--")) return r;
        r = getComputedStyle(document.documentElement).getPropertyValue(r);
        return r || void 0
    })
}! function(l) {
    "use strict";

    function r() {}
    r.prototype.respChart = function(r, o, e, a) {
        Chart.defaults.global.defaultFontColor = "#121212", Chart.defaults.scale.gridLines.color = "rgba(133, 141, 152, 0.1)";
        var t = r.get(0).getContext("2d"),
            n = l(r).parent();

        function i() {
            r.attr("width", l(n).width());
            switch (o) {
                case "Bar":
                    new Chart(t, {
                        type: "bar",
                        data: e,
                        options: a
                    });
                    break;
            }
        }
        l(window).resize(i), i()
    }, r.prototype.init = function() {
        // alert('hi');
        var December =localStorage.getItem('December');
        var November =localStorage.getItem('November');
        var October =localStorage.getItem('October');
        var September =localStorage.getItem('September');
        var August =localStorage.getItem('August');
        var July =localStorage.getItem('July');
        var June =localStorage.getItem('June');
        var May =localStorage.getItem('May');
        var April =localStorage.getItem('April');
        var March =localStorage.getItem('March'); 
        var Feb =localStorage.getItem('Feb'); 
        var Jan =localStorage.getItem('Jan'); 
        var year =localStorage.getItem('year'); 
        var r = getChartColorsArray("#bar"),
            r = {
                labels: ["January", "February", "March", "April", "May","June","July","August","September","October","November","December"],
                datasets: [{
                    label: 'My Brokerage [ '+year+' ] ₹',
                    fill: !0,
                    lineTension: .1,
                    backgroundColor: r[0],
                    borderColor: r[1],
                    borderCapStyle: "butt",
                    borderDash: [],
                    borderDashOffset: 0,
                    borderJoinStyle: "miter",
                    pointBorderColor: r[1],
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: r[1],
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: [Jan, Feb, March, April,May,June,July,August,September,October,November,December]
                }]
            };

        this.respChart(l("#bar"), "Bar", r, {
            scales: {
                xAxes: [{
                    barPercentage: .3
                }]
            }
        });
    }, l.ChartJs = new r, l.ChartJs.Constructor = r
}(window.jQuery),
function() {
    "use strict";
    window.jQuery.ChartJs.init()
}();






 
 