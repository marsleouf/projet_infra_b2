let bat;
bat = new batterie(4.2, "Li-ion");
temp = new temps();
window.addEventListener("load", load, false);
function load() {
  let obj;
  let xhttp = new XMLHttpRequest();
  xhttp.open("GET", "/Dashbord/server.php?battrie=battrie", true);
  xhttp.send();
  xhttp.onload = function () {
    const resulHtml = xhttp.responseText;
    try {
      obj = JSON.parse(resulHtml);
      console.log(obj);
      let obj1 = bat.unObjet(obj, "Batterie ");
      bat.creeBatterie("batt", obj1);
      let obj2 = temp.unObjetTemp(obj, "Temps ", "Temps 1");
      let obj3 = temp.unObjetTemp(obj, "Temps 2 ", "Temps 2 1");
      let data = {
        type: "Temps",
        vertical: false,
        titre: "Temp Salon",
        progres: {
          id: "progesBar1",
          label: ["", "°C"],
          value: obj2,
          min: -20,
          max: 127,
          width: "100%",
          height: "20px",
          color: "#fd7e14",
        },
      };
      let data1 = {
        type: "Temps",
        vertical: false,
        titre: "Temp verrre",
        progres: {
          id: "progesBar1",
          label: ["", "°C"],
          value: obj3,
          min: -20,
          max: 127,
          width: "50%",
          height: "30px",
          color: "#fd7e14",
        },
      };
      temp.Temp("batt", data);
      temp.Temp("batt", data1);
    } catch (err) {
      console.error("load error" + err.message);
    }
    //bat.creeCarte1("batt", "azerty")
    ///bat.creeCarte1("batt", "azerty1")
    //bat.creeCarte1("batt", "azerty1")
    //console.log(bat.betweenMinAndMax(-55, 127))
  };
}
let sec;
const nbse = document.getElementById("NBse");
sec = nbse.value;
res = setInterval(() => {
  sec = nbse.value;
  console.log(sec);
  let obj;
  let xhttp = new XMLHttpRequest();
  xhttp.open("GET", "/Dashbord/server.php?battrie=battrie", true);
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
      obj1 = bat.unObjet(obj, "Batterie ");
      bat.MoyenneBat("affiche", (objet = obj1));
      bat.UpdateAll(obj1);
      let obj2 = temp.unObjetTemp(obj, "Temps ", "Temps 1");
      data = { progres: { value: obj2 } };
      temp.Update(data);
    } catch (err) {
      //console.error("error");
    }
  };
  obj = null;
}, sec * 1000); /*
function UpdateApex(elem, objet = {}) {
    elem.updateOptions(objet);
}
UpdateApex(bat, { "series": [50, 50], });*/
