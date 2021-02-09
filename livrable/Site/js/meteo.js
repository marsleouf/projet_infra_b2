meteo = new Meteo();

function initmeteo() {
  loar();
}
function loar() {
  //var obj;
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "/Dashbord/API/APIMeteo.php?ME=1", true);
  xhttp.send();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 8 && this.status == 200) {
      console.log("Pas d'info");
    }
  };
  xhttp.onload = function () {
    const resulHtml = xhttp.responseText;
    try {
      obj = JSON.parse(resulHtml);
      console.log(obj);
      meteo.MeteoAffiche(obj);
    } catch (err) {
      console.error("load error" + err);
    }
  };
}
