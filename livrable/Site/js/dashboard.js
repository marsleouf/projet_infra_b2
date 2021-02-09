var col1 = "#31f500";
var col2 = "#ffbc00";
var color1 = "#31f500";
var color2 = "#ffbc00";
var eau;
var elec;
var gas;
let sun;
let rain;
let day = [];
var meteo = new Meteo();

!(function (o) {
  "use strict";
  function e() {
    (this.$body = o("body")), (this.charts = []);
  }
  (e.prototype.initCharts = function () {
    window.Apex = {
      chart: { parentHeightOffset: 0, toolbar: { show: !1 } },
      grid: { padding: { left: 0, right: 0 } },
      colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"],
    };
    var e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
    (r = o("#revenue-chart").data("colors")) && (e = r.split(","));
    var t = {
      chart: {
        height: 364,
        type: "line",
        dropShadow: { enabled: !0, opacity: 0.2, blur: 7, left: -7, top: 7 },
      },
      dataLabels: { enabled: !1 },
      stroke: { curve: "smooth", width: 4 },
      series: [
        { name: "Current Week", data: [10, 20, 15, 25, 20, 30, 80] },
        { name: "Previous Week", data: [0, 15, 10, 30, 15, 35, 90] },
      ],
      colors: e,
      zoom: { enabled: !1 },
      legend: { show: !1 },
      xaxis: {
        type: "string",
        categories: [
          "lundi",
          "mardi",
          "mecredi",
          "jeudi",
          "vendredi",
          "samedi",
          "dimanche",
        ],
        tooltip: { enabled: !1 },
        axisBorder: { show: !1 },
      },
      yaxis: {
        labels: {
          formatter: function (e) {
            return e + "k";
          },
          offsetX: -15,
        },
      },
    };
    new ApexCharts(document.querySelector("#revenue-chart"), t).render();

    // crecle 1 elec
    var r;
    var bla = document.getElementById("average-sales");
    var bla1 = bla.dataset.colors.split(",");
    var BatValue = parseInt(document.getElementById("BatValue").innerHTML);
    var BatResteValue = parseInt(
      document.getElementById("BatResteValue").innerHTML
    );
    var BatText = document.getElementById("BatText").innerHTML;
    var BatResteText = document.getElementById("BatResteText").innerHTML;
    r = o("#average-sales").data("colors") && (e = r.split(","));
    t = {
      chart: { id: "elec", height: 193, type: "donut" },
      legend: { show: !1 },
      stroke: { colors: ["transparent"] },
      series: [BatValue, BatResteValue],
      labels: [BatText, BatResteText],
      colors: [bla1[0], bla1[1]],
      responsive: [
        {
          breakpoint: 480,
          options: { chart: { width: 200 }, legend: { position: "bottom" } },
        },
      ],
    };
    elec = new ApexCharts(document.querySelector("#average-sales"), t);
    elec.render();
    //fin

    // crecle 2 eau
    var r;
    var bla1 = document.getElementById("average-sales1");
    var bla2 = bla1.dataset.colors1.split(",");

    (r = o("#average-sales").data("colors1")) && (e = r.split(","));
    t = {
      chart: { id: "eau", height: 193, type: "donut" },
      legend: { show: !1 },
      stroke: { colors: ["transparent"] },
      series: [8400000, 2400000],
      labels: ["eau", "vide", "Sponsored", "E-mail"],
      colors: [bla2[0], bla2[1]],
      responsive: [
        {
          breakpoint: 480,
          options: { chart: { width: 200 }, legend: { position: "bottom" } },
        },
      ],
    };
    eau = new ApexCharts(document.querySelector("#average-sales1"), t);
    eau.render();
    //fin

    // crecle 3 Gaz
    var r;
    var bla = document.getElementById("average-sales3");
    var bla1 = bla.dataset.colors3.split(",");
    (r = o("#average-sales").data("colors3")) && (e = r.split(","));
    t = {
      chart: { id: "gaz", height: 193, type: "donut" },
      legend: { show: !1 },
      stroke: { colors: ["transparent"] },
      series: [8400000, 3500000],
      labels: ["Direct", "Affilliate", "Sponsored", "E-mail"],
      colors: [bla1[0], bla1[1]],
      responsive: [
        {
          breakpoint: 480,
          options: { chart: { width: 200 }, legend: { position: "bottom" } },
        },
      ],
    };
    gas = new ApexCharts(document.querySelector("#average-sales3"), t);
    gas.render();
    //fin

    // crecle 4 crabu
    var r;
    var bla = document.getElementById("average-sales4");
    var bla1 = bla.dataset.colors4.split(",");
    (r = o("#average-sales").data("colors4")) && (e = r.split(","));
    t = {
      chart: { id: "crabu", height: 193, type: "donut" },
      legend: { show: !1 },
      stroke: { colors: ["transparent"] },
      series: [8400000, 3500000],
      labels: ["Direct", "Affilliate", "Sponsored", "E-mail"],
      colors: [bla1[0], bla1[1]],
      responsive: [
        {
          breakpoint: 480,
          options: { chart: { width: 200 }, legend: { position: "bottom" } },
        },
      ],
    };
    new ApexCharts(document.querySelector("#average-sales4"), t).render();
    //fin
    // crecle 5 crabu
    /*
    var r;
    var bla = document.getElementById("average-sales5");
    var bla1 = bla.dataset.colors5.split(",");
    (r = o("#average-sales4").data("colors5")) && (e = r.split(","));
    t = {
      chart: { id: "cradu1", height: 193, type: "donut" },
      legend: { show: !1 },
      stroke: { colors: ["transparent"] },
      series: [3500000, 8400000],

      labels: ["Direct", "Affilliate", "Sponsored", "E-mail"],
      colors: [bla1[0], bla1[1]],
      responsive: [
        {
          breakpoint: 480,
          options: { chart: { width: 200 }, legend: { position: "bottom" } },
        },
      ],
    };
    new ApexCharts(document.querySelector("#average-sales5"), t).render();
    */
    //
    //fin
  }),
    (e.prototype.initMaps = function () {
      0 < o("#world-map-markers").length &&
        o("#world-map-markers").vectorMap({
          map: "world_mill_en",
          normalizeFunction: "polynomial",
          hoverOpacity: 0.7,
          hoverColor: !1,
          regionStyle: { initial: { fill: "#e3eaef" } },
          markerStyle: {
            initial: {
              r: 9,
              fill: "#727cf5",
              "fill-opacity": 0.9,
              stroke: "#fff",
              "stroke-width": 7,
              "stroke-opacity": 0.4,
            },
            hover: { stroke: "#fff", "fill-opacity": 1, "stroke-width": 1.5 },
          },
          backgroundColor: "transparent",
          markers: [
            { latLng: [40.71, -74], name: "New York" },
            { latLng: [37.77, -122.41], name: "San Francisco" },
            { latLng: [-33.86, 151.2], name: "Sydney" },
            { latLng: [1.3, 103.8], name: "Singapore" },
          ],
          zoomOnScroll: !1,
        });
    }),
    (e.prototype.init = function () {
      o("#dash-daterange").daterangepicker({ singleDatePicker: !0 }),
        this.initCharts(),
        this.initMaps();
      batte();
    }),
    (o.Dashboard = new e()),
    (o.Dashboard.Constructor = e);
})(window.jQuery),
  (function (t) {
    "use strict";
    t(document).ready(function (e) {
      t.Dashboard.init();
    });
  })(window.jQuery);

function des() {
  eau.destroy();
}
function ajo() {
  //var
  var t;
  var bla1 = document.getElementById("average-sales1");
  var bla2 = bla1.dataset.colors1.split(",");
  t = {
    chart: { id: "eau", height: 193, type: "donut" },
    legend: { show: !1 },
    stroke: { colors: ["transparent"] },
    series: [8400000, 2400000],
    labels: ["eau", "vide", "Sponsored", "E-mail"],
    colors: [bla2[0], bla2[1]],
    responsive: [
      {
        breakpoint: 480,
        options: { chart: { width: 200 }, legend: { position: "bottom" } },
      },
    ],
  };
  eau = new ApexCharts(document.querySelector("#average-sales1"), t);
  eau.render();
}
function up1() {
  UpdateApex(eau, { series: [50, 89] });
  UpdateApex(elec, { series: [50, 89] });
  UpdateApex(gas, { series: [50, 89] });
}
function up2() {
  UpdateApex(eau, { series: [32, 90] });
  UpdateApex(elec, { series: [32, 90] });
  UpdateApex(gas, { series: [32, 90] });
}
function up3() {
  UpdateApex(eau, { series: [50, 50] });
  UpdateApex(elec, { series: [200, 0] });
  UpdateApex(gas, { series: [50, 50] });
}
function UpdateApex(elem, objet = {}) {
  elem.updateOptions(objet);
}
var batt = new batterie();
function batte() {
  loar();
  try {
    res = setInterval(() => {
      // var obj;

      // var xhttp = new XMLHttpRequest();
      // xhttp.open("GET", "/Dashbord/server.php?battrie=battrie", true);
      // xhttp.send();
      // xhttp.onload = function () {
      //   const resulHtml = xhttp.responseText;
      //   obj = JSON.parse(resulHtml);
      //   console.log(
      //     batt.MoyenneBat(
      //       "",
      //       (objet = batt.unObjet(obj, "Batterie ")),
      //       (ob = true)
      //     )
      //   );
      //   UpdateApex(elec, {
      //     series: batt.MoyenneBat(
      //       "",
      //       (objet = batt.unObjet(obj, "Batterie ")),
      //       (ob = true)
      //     ),
      //   });
      //   obj = null;
      // };

      var obj1;
      var xhttp1 = new XMLHttpRequest();
      xhttp1.open("GET", "/Dashbord/API/APIMeteo.php?ME=2", true);
      xhttp1.send();
      xhttp1.onload = function () {
        const resulHtml = xhttp1.responseText;
        console.log(resulHtml);
        obj1 = JSON.parse(resulHtml);
        console.log(obj1.sun_hours);
        UpdateApex(sun, {
          series: [
            {
              name: "Actual",
              data: obj1.sun_hours,
            },
            // {
            //   name: "Projection",
            //   data: [12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12],
            // },
          ],
        });
        UpdateApex(rain, {
          series: [
            {
              name: "Actual",
              data: obj1.rr10,
            },
            {
              name: "Projection",
              data: obj1.rr1,
            },
          ],
        });
        //UpdateApex(elec);
        //obj = null;
      };
    }, 15000);
  } catch (err) {}
}

function loar() {
 
  var obj;
  try {
    // var xhttp = new XMLHttpRequest();
    // xhttp.open("GET", "/Dashbord/server.php?battrie=battrie", true);
    // xhttp.send();
    // xhttp.onload = function () {
    //   const resulHtml = xhttp.responseText;
    //   obj = JSON.parse(resulHtml);
    //   console.log(batt.MoyenneBat("", (objet = obj), (ob = true)));
    //   UpdateApex(elec, {
    //     series: batt.MoyenneBat(
    //       "",
    //       (objet = batt.unObjet(obj, "Batterie ")),
    //       (ob = true)
    //     ),
    //   });
    //   obj = null;
    // };
    var obj1;
    var xhttp1 = new XMLHttpRequest();
    xhttp1.open("GET", "/Dashbord/API/APIMeteo.php?ME=2", true);
    xhttp1.send();
    xhttp1.onload = function () {
      const resulHtml = xhttp1.responseText;
      console.log(resulHtml);
      obj1 = JSON.parse(resulHtml);
      for (let index = 0; index < obj1.day.length; index++) {
        const value = obj1.day[index];
        console.log(meteo.dateday(value));
        day.push(meteo.dateday(value));
      }
      console.log(obj1.sun_hours);
      console.log(day);

      e = ["#ffbc00", "#0acf97", "#fa5c7c", "#31f500"];
      //r = o("#high-performing-product").data("colors");
      t = {
        chart: { height: 257, type: "bar", stacked: !1 },
        plotOptions: { bar: { horizontal: !1, columnWidth: "55%" } },
        dataLabels: { enabled: !1 },
        stroke: { show: !0, width: 2, colors: ["transparent"] },
        series: [
          {
            name: "Actual",
            data: obj1.sun_hours,
          },
          // {
          //   name: "Projection",
          //   data: [12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12],
          // },
        ],
        zoom: { enabled: !1 },
        legend: { show: !1 },
        colors: e,
        xaxis: {
          categories: day,
          axisBorder: { show: !1 },
        },
        yaxis: {
          labels: {
            formatter: function (e) {
              return e + "h  ";
            },
            offsetX: -15,
          },
        },
        fill: { opacity: 1 },
        tooltip: {
          y: {
            formatter: function (e) {
              return "" + e + "h";
            },
          },
        },
      };
      sun = new ApexCharts(
        document.querySelector("#high-performing-product"),
        t
      );
      sun.render();

      e = ["#067ff0", "#0acf97", "#fa5c7c", "#ffbc00"];
      //r = o("#high-performing-product1").data("colors");
      t = {
        chart: { height: 257, type: "bar", stacked: !1 },
        plotOptions: { bar: { horizontal: !1, columnWidth: "55%" } },
        dataLabels: { enabled: !1 },
        stroke: { show: !0, width: 2, colors: ["transparent"] },
        series: [
          {
            name: "Actual",
            data: obj1.rr10,
          },
          {
            name: "Max Jour",
            data: obj1.rr1,
          },
        ],
        zoom: { enabled: !1 },
        legend: { show: !1 },
        colors: e,
        xaxis: {
          categories: day,
          axisBorder: { show: !1 },
        },
        yaxis: {
          labels: {
            formatter: function (e) {
              return e + "mm";
            },
            offsetX: -15,
          },
        },
        fill: { opacity: 1 },
        tooltip: {
          y: {
            formatter: function (e) {
              return "$" + e + "mm";
            },
          },
        },
      };
      rain = new ApexCharts(
        document.querySelector("#high-performing-product1"),
        t
      );
      rain.render();
      //UpdateApex(elec);
      //obj = null;
    };
  } catch (err) {
    console.log(err);
  }

  // <li class="side-nav-title side-nav-item">Navigation</li>

  //           <li class="side-nav-item">
  //               <a href="javascript: void(0);" class="side-nav-link">
  //                   <img class="uil-home-alt" src="icons/columns-gap.svg"></img>
  //                   <span class="badge badge-success float-right">4</span>
  //                   <span> Dashboards </span>
  //               </a>
  //               <ul class="side-nav-second-level" aria-expanded="false">
  //                   <li>
  //                       <a href="/Dashbord/index.php">Dashboards</a>
  //                   </li>
  //                   <li>
  //                       <a href="/Dashbord/eclairage.php">Eclairage</a>
  //                   </li>
  //                   <li>
  //                       <a href="/Dashbord/prise.php">Prise</a>
  //                   </li>
  //                   <li>
  //                       <a href="dashboard-projects.html">Projects</a>
  //                   </li>
  //               </ul>
  //           </li>
}
