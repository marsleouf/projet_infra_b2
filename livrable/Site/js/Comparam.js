function save() {
  var xhttp = new XMLHttpRequest();
  var id = document.getElementById("load");
  var spi = document.getElementById("spi");
  spi.className = "spinner-border spinner text-warning spi";
  var darkmode;
  var bar_theme;
  var menu_decaler;
  var bar;

  //id.prop("checked", !0);
  console.log(id.dataset);

  if (id.dataset.leftbarCompactMode) {
    if (id.dataset.leftbarCompactMode == "condensed") {
      bar = "condensed";
    } else if (id.dataset.leftbarCompactMode == "scrollable") {
      bar = "scrollable";
    } else {
      bar = "fixed";
    }
  }
  if (id.dataset.leftbarTheme) {
    if (id.dataset.leftbarTheme == "dark") {
      bar_theme = "dark";
    } else if (id.dataset.leftbarTheme == "light") {
      bar_theme = "light";
    } else {
      bar_theme = "defaut";
    }
  }
  if (id.dataset.boxed) {
    if (id.dataset.boxed == "true") {
      menu_decaler = 1;
    } else if (id.dataset.boxed == "false") {
      menu_decaler = 0;
    } else {
    }
  }
  if (id.dataset.dark) {
    if (id.dataset.dark == "true") {
      darkmode = 1;
    } else if (id.dataset.dark == "false") {
      darkmode = 0;
    }
  }

  xhttp.open("POST", "/Dashbord/parametre_sql.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      spi.className = "spinner-border spinner text-light spi";
    }
  };
  xhttp.send(
    "bartheme=" +
      bar_theme +
      "&darkmode=" +
      darkmode +
      "&menudecaler=" +
      menu_decaler +
      "&bar=" +
      bar +
      "&mode=1"
  );

  xhttp.onload = function () {
    const resulHtml = xhttp.responseText;
    res = setInterval(() => {
      if (resulHtml) {
        if (parseInt(resulHtml) == 1) {
          spi = document.getElementById("spi");
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
      }
    }, 2000);
  };

  console.log("oksave");
}
