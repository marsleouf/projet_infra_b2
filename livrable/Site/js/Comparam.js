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
    bar = id.dataset.leftbarCompactMode;
  }
  if (id.dataset.leftbarTheme) {
    bar_theme = id.dataset.leftbarTheme;
  } else {
    bar_theme = "defaut";
  }
  if (id.dataset.boxed) {
    console.log(id.dataset.boxed);
    menu_decaler = id.dataset.boxed;
  }
  if (id.dataset.dark) {
    darkmode = id.dataset.dark;
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
