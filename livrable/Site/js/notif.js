window.addEventListener("load", load, false);
var notif = new notification("notif");
function load() {
  var obj;
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "/Dashbord/notification.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("mode=1");
  xhttp.onload = function () {
    const resulHtml = xhttp.responseText;
    obj = JSON.parse(resulHtml);
    //console.log(obj);
    //dr();
    //bat.creeCarte1("batt", "azerty")
    ///bat.creeCarte1("batt", "azerty1")
    //bat.creeCarte1("batt", "azerty1")
    //console.log(bat.betweenMinAndMax(-55, 127))
  };
}

// function dr() {
//   notif.Cree();
//   notif.Cree();
//   notif.Cree();
// }
function clearAll() {
  notif.clearAll();
}

function notification(idNotification) {
  this.idNotification = document.getElementById(idNotification).parentElement;
  this.clearAll = function () {
    this.idNotification.innerText = "";
  };
  this.Cree = function () {
    var notification = this.idNotification;

    var item = document.createElement("a");
    item.href = "javascript:void(0);";
    item.className = "dropdown-item notify-item";

    var divimg = document.createElement("div");
    divimg.className = "notify-icon bg-primary";
    var img = document.createElement("img");
    img.className = "mdi mdi-comment-account-outline notificon";
    img.src = "icons/diagram-3.svg";
    divimg.appendChild(img);
    item.appendChild(divimg);

    var titre = document.createElement("p");
    titre.innerText = "server";
    titre.className = "notify-details";
    item.appendChild(titre);

    var value = document.createElement("p");
    value.className = "notify-details";
    value.innerText = "Bug Server";

    var date = document.createElement("small");
    date.className = "text-muted";
    date.innerText = "18 m";
    value.appendChild(date);

    var destroy = document.createElement("small");
    destroy.className = "text-muted btn btn1";
    destroy.onclick = "javascript:up2();";

    var imgDestroy = document.createElement("img");
    imgDestroy.className = "notificon";
    imgDestroy.src = "icons/trash.svg";
    destroy.appendChild(imgDestroy);
    value.appendChild(destroy);
    item.appendChild(value);
    notification.appendChild(item);
  };
  this.Update = function () {};
}
