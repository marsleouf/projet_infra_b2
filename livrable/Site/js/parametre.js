let color1 = "";
let color2 = "";
let color3 = "";
let color4 = "";
let color5 = "";
let color6 = "";
let color7 = "";
let color8 = "";
let defaultColor1 = "";
let defaultColor2 = "";
let defaultColor3 = "";
let defaultColor4 = "";
let defaultColor5 = "";
let defaultColor6 = "";
let defaultColor7 = "";
let defaultColor8 = "";
let nom = "";
let insee = "";
let codesPostaux = "";
let codeDepartement = "";
!(function (o) {
  "use strict";
  function e() {
    (this.$body = o("body")), (this.charts = []);
  }
  (e.prototype.initCharts = initCrecle()),
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
        //this.initCharts(),
        this.initMaps();
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

function initCrecle() {
  // crecle 1
  let t = {};
  var bla = document.getElementById("average-sales1");
  var bla1 = bla.dataset.colors.split(",");
  defaultColor1 = bla1[0];
  defaultColor2 = bla1[1];
  t = {
    chart: { id: "elec", height: 193, type: "donut" },
    legend: { show: !1 },
    stroke: { colors: ["transparent"] },
    series: [840000, 350000],
    labels: ["Produite ", "Prevision du jour "],
    colors: [bla1[0], bla1[1]],
    responsive: [
      {
        breakpoint: 480,
        options: { chart: { width: 200 }, legend: { position: "bottom" } },
      },
    ],
  };
  new ApexCharts(document.querySelector("#average-sales1"), t).render();
  // fin

  // cercle 2
  var bla = document.getElementById("average-sales2");
  var bla1 = bla.dataset.colors1.split(",");
  /*defaultColor3 = bla1[0];
  defaultColor4 = bla1[1];*/

  t = {
    chart: { id: "eau", height: 193, type: "donut" },
    legend: { show: !1 },
    stroke: { colors: ["transparent"] },
    series: [2000, 1000],
    labels: ["Eau ", "Reste"],
    colors: [bla1[0], bla1[1]],
    responsive: [
      {
        breakpoint: 480,
        options: { chart: { width: 200 }, legend: { position: "bottom" } },
      },
    ],
  };
  new ApexCharts(document.querySelector("#average-sales2"), t).render();
  // fin
  // cercle 3
  var bla = document.getElementById("average-sales3");
  var bla1 = bla.dataset.colors3.split(",");
  /*defaultColor3 = bla1[0];
    defaultColor4 = bla1[1];*/

  t = {
    chart: { id: "eau", height: 193, type: "donut" },
    legend: { show: !1 },
    stroke: { colors: ["transparent"] },
    series: [2000, 1000],
    labels: ["Eau ", "Reste"],
    colors: [bla1[0], bla1[1]],
    responsive: [
      {
        breakpoint: 480,
        options: { chart: { width: 200 }, legend: { position: "bottom" } },
      },
    ],
  };
  new ApexCharts(document.querySelector("#average-sales3"), t).render();
  // fin
    // cercle 3
  var bla = document.getElementById("average-sales4");
  var bla1 = bla.dataset.colors4.split(",");
  /*defaultColor3 = bla1[0];
    defaultColor4 = bla1[1];*/

  t = {
    chart: { id: "eau", height: 193, type: "donut" },
    legend: { show: !1 },
    stroke: { colors: ["transparent"] },
    series: [2000, 1000],
    labels: ["Eau ", "Reste"],
    colors: [bla1[0], bla1[1]],
    responsive: [
      {
        breakpoint: 480,
        options: { chart: { width: 200 }, legend: { position: "bottom" } },
      },
    ],
  };
  new ApexCharts(document.querySelector("#average-sales4"), t).render();
  // fin
}
window.addEventListener("load", startup, false);
const meteo = function(e) {
  //const button = event.target;
  let input = e.target;
  console.log(input.value)
    ///spi.className = "spinner-border spinner text-warning spi";
  const env = "nom="+input.value+"&mode=5"
  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "/Dashbord/parametre_sql.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //spi.className = "spinner-border spinner text-light spi";
    }
  };
  xhttp.send(env);
  xhttp.onload = function () {
    const resulHtml = JSON.parse(xhttp.responseText);
    console.log(resulHtml)
   let spi = document.getElementById("nom45");
      spi.innerText = "";
      resulHtml.forEach(element => {
        const a = document.createElement('a');
        a.innerText = element.nom
        a.className = "dropdown-item"
        a.href = `javascript:modifNom("${element.nom}",${element.id_insee});`
        spi.appendChild(a)
      });
  }
};
function modifNom(nom1,id) {
  const input = document.getElementById("dropdownMenuLink45");
  const codeDepartement1 = document.getElementById("codedep");
  const codesPostaux1 = document.getElementById("codepos");
  input.value = nom1;
  const env = `id=${id}&mode=6`
  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "/Dashbord/parametre_sql.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //spi.className = "spinner-border spinner text-light spi";
    }
  };
  xhttp.send(env);
  xhttp.onload = function () {
    const resulHtml = JSON.parse(xhttp.responseText);
    const res = resulHtml[0];
    console.log(res.nom, res.codeDepartement, res.codesPostaux, res.insee)
    codeDepartement = res.codeDepartement
    codesPostaux = res.codesPostaux
    insee = res.insee
    nom = res.nom
    codesPostaux1.value = res.codesPostaux
    codeDepartement1.value = res.codeDepartement
  }
}
function ajouterMeteo() {
  const env = `nom=${nom}&codeDepartement=${codeDepartement}&codesPostaux=${codesPostaux}&insee=${insee}&mode=7`
  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "/Dashbord/parametre_sql.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //spi.className = "spinner-border spinner text-light spi";
    }
  };
  xhttp.send(env);
  console.log(env)
  xhttp.onload = function () {
    const resulHtml = xhttp.responseText;
    console.log(resulHtml)
    window.location.reload();
  }

}
function startupMeteo() {
  const env = "mode=8"
  let xhttp = new XMLHttpRequest();
  const input = document.getElementById("dropdownMenuLink45");
  const codeDepartement1 = document.getElementById("codedep");
  const codesPostaux1 = document.getElementById("codepos");
  xhttp.open("POST", "/Dashbord/parametre_sql.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //spi.className = "spinner-border spinner text-light spi";
    }
  };
  xhttp.send(env);
  xhttp.onload = function () {
    const resulHtml = JSON.parse(xhttp.responseText);
    console.log(resulHtml)
      resulHtml.forEach(element => {
        input.value = element.nom
        codeDepartement1.value = element.codeDepartement
        codesPostaux1.value = element.codesPostaux
        insee = element.insee
        codeDepartement = element.codeDepartement
        codesPostaux = element.codesPostaux
        nom = element.nom
      });
  }
}
function startup() {
  document.getElementById("dropdownMenuLink45").addEventListener('input', meteo, false)
  startupMeteo();
  let elec = document.getElementById("average-sales1");
  let elec1 = elec.dataset.colors.split(",");
  defaultColor1 = elec1[0];
  defaultColor2 = elec1[1];
  let colorElec = document.querySelector("#colorelec");
  colorElec.value = defaultColor1;
  colorElec.addEventListener("input", updateColorElec1, false);
  colorElec.addEventListener("change", updateColorAllElec1, false);
  colorElec.select();
  let colorElec1 = document.querySelector("#colorelec1");
  colorElec1.value = defaultColor2;
  colorElec1.addEventListener("input", updateColorElec2, false);
  colorElec1.addEventListener("change", updateColorAllElec2, false);
  colorElec1.select();

  let eau = document.getElementById("average-sales2");
  let eau1 = eau.dataset.colors1.split(",");
  defaultColor3 = eau1[0];
  defaultColor4 = eau1[1];
  let colorEau = document.querySelector("#coloreau");
  colorEau.value = defaultColor3;
  colorEau.addEventListener("input", updateColorEau1, false);
  colorEau.addEventListener("change", updateColorAllEau1, false);
  colorEau.select();
  let colorEau1 = document.querySelector("#coloreau1");
  colorEau1.value = defaultColor4;
  colorEau1.addEventListener("input", updateColorEau2, false);
  colorEau1.addEventListener("change", updateColorAllEau2, false);
  colorEau1.select();

  let Gaz = document.getElementById("average-sales3");
  let Gaz1 = Gaz.dataset.colors3.split(",");
  defaultColor5 = Gaz1[0];
  defaultColor6 = Gaz1[1];
  let colorGaz = document.querySelector("#colorGaz");
  colorGaz.value = defaultColor5;
  colorGaz.addEventListener("input", updateColorGaz1, false);
  colorGaz.addEventListener("change", updateColorAllGaz1, false);
  colorGaz.select();
  let colorGaz1 = document.querySelector("#colorGaz1");
  colorGaz1.value = defaultColor6;
  colorGaz1.addEventListener("input", updateColorGaz2, false);
  colorGaz1.addEventListener("change", updateColorAllGaz2, false);
  colorGaz1.select();

  
  let Crabu = document.getElementById("average-sales4");
  let Crabu1 = Crabu.dataset.colors4.split(",");
  defaultColor7 = Crabu1[0];
  defaultColor8 = Crabu1[1];
  let colorCrabu = document.querySelector("#colorCrabu");
  colorCrabu.value = defaultColor7;
  colorCrabu.addEventListener("input", updateColorCrabu1, false);
  colorCrabu.addEventListener("change", updateColorAllCrabu1, false);
  colorCrabu.select();
  let colorCrabu1 = document.querySelector("#colorCrabu1");
  colorCrabu1.value = defaultColor8;
  colorCrabu1.addEventListener("input", updateColorCrabu2, false);
  colorCrabu1.addEventListener("change", updateColorAllCrabu2, false);
  colorCrabu1.select();

  color1 = defaultColor1;
  color2 = defaultColor2;
  color3 = defaultColor3;
  color4 = defaultColor4;
  color5 = defaultColor5;
  color6 = defaultColor6;
  color7 = defaultColor7;
  color8 = defaultColor8;


}

function updateColorElec1(event) {
  color("SvgjsPath1013", event.target.value);
  color1 = event.target.value;
  let col = document.getElementById("colr1");
  col.style.backgroundColor = event.target.value;
}
function updateColorAllElec1(event) {
  document.getElementById("notifcolor").forEach(function (p) {
    span.style.color = event.target.value;
    color1 = event.target.value;
  });
}
function updateColorElec2(event) {
  color("SvgjsPath1022", event.target.value);
  color2 = event.target.value;
  let col = document.getElementById("colr2");
  col.style.backgroundColor = event.target.value;
}
function updateColorAllElec2(event) {
  document.getElementById("notifcolor1").forEach(function (p) {
    span.style.color = event.target.value;
    color2 = event.target.value;
  });
}

function updateColorEau1(event) {
  color("SvgjsPath1044", event.target.value);
  color3 = event.target.value;
  let col = document.getElementById("colr3");
  col.style.backgroundColor = event.target.value;
}
function updateColorAllEau1(event) {
  document.getElementById("notifcolor").forEach(function (p) {
    span.style.color = event.target.value;
    color3 = event.target.value;
  });
}
function updateColorEau2(event) {
  color("SvgjsPath1053", event.target.value);
  color4 = event.target.value;
  let col = document.getElementById("colr4");
  col.style.backgroundColor = event.target.value;
}
function updateColorAllEau2(event) {
  document.getElementById("notifcolor1").forEach(function (p) {
    span.style.color = event.target.value;
    color4 = event.target.value;
  });
}

function updateColorGaz1(event) {
  color5 = event.target.value;
  color("SvgjsPath1075", event.target.value);
  let col = document.getElementById("colr5");
  col.style.backgroundColor = event.target.value;
}
function updateColorAllGaz1(event) {
  document.getElementById("notifcolor").forEach(function (p) {
    span.style.color = event.target.value;
    color5 = event.target.value;
  });
}
function updateColorGaz2(event) {
  color6 = event.target.value;
  color("SvgjsPath1084", event.target.value);
  let col = document.getElementById("colr6");
  col.style.backgroundColor = event.target.value;
}
function updateColorAllGaz2(event) {
  document.getElementById("notifcolor1").forEach(function (p) {
    span.style.color = event.target.value;
    color6 = event.target.value;
  });
}

function updateColorCrabu1(event) {
  color7 = event.target.value;
  color("SvgjsPath1106", event.target.value);
  let col = document.getElementById("colr7");
  col.style.backgroundColor = event.target.value;
}
function updateColorAllCrabu1(event) {
  document.getElementById("notifcolor").forEach(function (p) {
    span.style.color = event.target.value;
    color7 = event.target.value;
  });
}
function updateColorCrabu2(event) {
  color8 = event.target.value;
  color("SvgjsPath1115", event.target.value);
  let col = document.getElementById("colr8");
  col.style.backgroundColor = event.target.value;
}
function updateColorAllCrabu2(event) {
  document.getElementById("notifcolor1").forEach(function (p) {
    span.style.color = event.target.value;
    color8 = event.target.value;
  });
}


function color(id, color) {
  let color1 = document.getElementById(id);
  color1.attributes.fill.value = color;
}
/*
function color7(id, color) {
  let color1 = document.getElementById(id);
  color1.attributes.fill.value = color;
  let bla = document.getElementById("average-sales");
  //console.log(bla.dataset.colors);
}
*/
function saveElec() {
  if (color1 == "") {
    alert("il faut entrée la couleur ou modifier Couleur 1");
  } else if (color2 == "") {
    alert("il faut entrée la couleur ou modifier Couleur 2");
  } else {
    let xhttp = new XMLHttpRequest();
    let spi = document.getElementById("elec");
    spi.className = "spinner-border spinner text-warning spi";
    xhttp.open("POST", "/Dashbord/parametre_sql.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        spi.className = "spinner-border spinner text-light spi";
      }
    };
    xhttp.send("color1=" + color1 + "&color2=" + color2 + "&mode=2");

    xhttp.onload = function () {
      const resulHtml = xhttp.responseText;
      res = setInterval(() => {
        console.log("f");
        if (resulHtml) {
          if (parseInt(resulHtml) == 1) {
            spi = document.getElementById("elec");
            res1 = setInterval(() => {
              spi.className = "";
              clearInterval(res);
              clearInterval(res1);
              window.location.reload();
            }, 1000);
            spi.className = "spinner-border spinner text-success spi";
            clearInterval(res);
            console.log(parseInt(resulHtml));
          }
          if (parseInt(resulHtml) == 0) {
            spi.className = "spinner-border spinner text-danger spi";
          }
          console.log(resulHtml);
        }
      }, 2000);
    };
  }
  console.log("oksave");
}
function saveEau() {
  if (color3 == "") {
    alert("il faut entrée la couleur ou modifier Couleur 1");
  } else if (color4 == "") {
    alert("il faut entrée la couleur ou modifier Couleur 2");
  } else {
    let xhttp = new XMLHttpRequest();
    let spi = document.getElementById("eau");
    spi.className = "spinner-border spinner text-warning spi";
    xhttp.open("POST", "/Dashbord/parametre_sql.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        spi.className = "spinner-border spinner text-light spi";
      }
    };
    xhttp.send("color3=" + color3 + "&color4=" + color4 + "&mode=3");

    xhttp.onload = function () {
      const resulHtml = xhttp.responseText;
      res = setInterval(() => {
        console.log("f");
        if (resulHtml) {
          if (parseInt(resulHtml) == 1) {
            spi = document.getElementById("eau");
            res1 = setInterval(() => {
              spi.className = "";
              clearInterval(res);
              clearInterval(res1);
              window.location.reload();
            }, 1000);
            spi.className = "spinner-border spinner text-success spi";
            clearInterval(res);
            console.log(parseInt(resulHtml));
          }
          if (parseInt(resulHtml) == 0) {
            spi.className = "spinner-border spinner text-danger spi";
          }
          console.log(resulHtml);
        }
      }, 2000);
    };
  }
  console.log("oksave");
}
function saveGaz() {
  if (color5 == "") {
    alert("il faut entrée la couleur ou modifier Couleur 1");
  } else if (color6 == "") {
    alert("il faut entrée la couleur ou modifier Couleur 2");
  } else {
    let xhttp = new XMLHttpRequest();
    let spi = document.getElementById("gaz");
    spi.className = "spinner-border spinner text-warning spi";
    xhttp.open("POST", "/Dashbord/parametre_sql.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        spi.className = "spinner-border spinner text-light spi";
      }
    };
    xhttp.send("color5=" + color5 + "&color6=" + color6 + "&mode=4");

    xhttp.onload = function () {
      const resulHtml = xhttp.responseText;
      res = setInterval(() => {
        console.log("f");
        if (resulHtml) {
          if (parseInt(resulHtml) == 1) {
            spi = document.getElementById("gaz");
            res1 = setInterval(() => {
              spi.className = "";
              clearInterval(res);
              clearInterval(res1);
              window.location.reload();
            }, 1000);
            spi.className = "spinner-border spinner text-success spi";
            clearInterval(res);
            console.log(parseInt(resulHtml));
          }
          if (parseInt(resulHtml) == 0) {
            spi.className = "spinner-border spinner text-danger spi";
          }
          console.log(resulHtml);
        }
      }, 2000);
    };
  }
  console.log("oksave");
}
function saveCrabu() {
  if (color7 == "") {
    alert("il faut entrée la couleur ou modifier Couleur 1");
  } else if (color8 == "") {
    alert("il faut entrée la couleur ou modifier Couleur 2");
  } else {
    let xhttp = new XMLHttpRequest();
    let spi = document.getElementById("Crabu");
    spi.className = "spinner-border spinner text-warning spi";
    xhttp.open("POST", "/Dashbord/parametre_sql.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        spi.className = "spinner-border spinner text-light spi";
      }
    };
    xhttp.send("color7=" + color7 + "&color8=" + color8 + "&mode=9");

    xhttp.onload = function () {
      const resulHtml = xhttp.responseText;
      res = setInterval(() => {
        console.log("f");
        if (resulHtml) {
          if (parseInt(resulHtml) == 1) {
            spi = document.getElementById("gaz");
            res1 = setInterval(() => {
              spi.className = "";
              clearInterval(res);
              clearInterval(res1);
              window.location.reload();
            }, 1000);
            spi.className = "spinner-border spinner text-success spi";
            clearInterval(res);
            console.log(parseInt(resulHtml));
          }
          if (parseInt(resulHtml) == 0) {
            spi.className = "spinner-border spinner text-danger spi";
          }
          console.log(resulHtml);
        }
      }, 2000);
    };
  }
  console.log("oksave");
}