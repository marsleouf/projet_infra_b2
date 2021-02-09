function request(type, url, value = "") {
  return new Promise((resolve) => {
    var xhttp = new XMLHttpRequest();
    xhttp.open(type, url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if (type != "GET" && type != "POST") {
      xhttp.setRequestHeader("Data", value);
    }
    xhttp.send(value);
    xhttp.onload = () => {
      if (xhttp.responseText != "") {
        //console.log(xhttp.responseText, "text");
        let resJson1;
        if (typeof xhttp.responseText == "object") {
          resJson1 = JSON.parse(xhttp.responseText);
        } else {
          resJson1 = xhttp.responseText;
        }
        console.log(resJson1);
        resolve(resJson1);
      }
    };
  });
}
function ajouter() {
  var xhttp = new XMLHttpRequest();
  var nom = document.getElementById("nom");
  var prenom = document.getElementById("prenom");
  var mail = document.getElementById("mail");
  var mdp = document.getElementById("mdp");
  var type = document.getElementById("type");
  var button = document.getElementById("btnajou");
  var nom1 = nom.value;
  var prenom1 = prenom.value;
  var mail1 = mail.value;
  var mdp1 = mdp.value;
  var type1 = type.value;
  button.className = "spinner-border spinner text-warning spi";

  xhttp.open("POST", "/Dashbord/utilisateur_sql.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      button.className = "spinner-border spinner text-light spi";
    }
  };
  xhttp.send(
    "nom=" +
      nom1 +
      "&prenom=" +
      prenom1 +
      "&mail=" +
      mail1 +
      "&mdp=" +
      mdp1 +
      "&type=" +
      type1 +
      "&mode=0"
  );

  xhttp.onload = function () {
    const resulHtml = xhttp.responseText;
    res = setInterval(() => {
      console.log("f");
      if (resulHtml) {
        if (parseInt(resulHtml) == 1) {
          button = document.getElementById("btnajou");
          res1 = setInterval(() => {
            button.className = "";
            clearInterval(res);
            clearInterval(res1);
            window.location.reload();
          }, 1000);
          button.className = "spinner-border spinner text-success spi";
          clearInterval(res);
          console.log(parseInt(resulHtml));
        }
        if (parseInt(resulHtml) == 0) {
          button.className = "spinner-border spinner text-danger spi";
        }
        console.log(resulHtml);
      }
    }, 2000);
  };

  console.log("ok ajouter");
}
function modifier() {
  var xhttp = new XMLHttpRequest();
  var nom = document.getElementById("nom1");
  var prenom = document.getElementById("prenom1");
  var mail = document.getElementById("mail1");
  var mdp = document.getElementById("mdp1");
  var type = document.getElementById("type1");
  var id = document.getElementById("id");
  var button = document.getElementById("btnmodif");
  var id1 = id.value;
  var nom1 = nom.value;
  var prenom1 = prenom.value;
  var mail1 = mail.value;
  var mdp1 = mdp.value;
  var type1 = type.value;
  button.className = "spinner-border spinner text-warning spi";

  xhttp.open("POST", "/Dashbord/utilisateur_sql.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      button.className = "spinner-border spinner text-light spi";
    }
  };
  xhttp.send(
    "id=" +
      id1 +
      "&nom=" +
      nom1 +
      "&prenom=" +
      prenom1 +
      "&mail=" +
      mail1 +
      "&mdp=" +
      mdp1 +
      "&type=" +
      type1 +
      "&mode=1"
  );

  xhttp.onload = function () {
    const resulHtml = xhttp.responseText;
    res = setInterval(() => {
      console.log("f");
      if (resulHtml) {
        if (parseInt(resulHtml) == 1) {
          button = document.getElementById("btnmodif");
          res1 = setInterval(() => {
            button.className = "";
            clearInterval(res);
            clearInterval(res1);
            window.location.reload();
          }, 1000);
          button.className = "spinner-border spinner text-success spi";
          clearInterval(res);
          console.log(parseInt(resulHtml));
        }
        if (parseInt(resulHtml) == 0) {
          button.className = "spinner-border spinner text-danger spi";
        }
        console.log(resulHtml);
      }
    }, 2000);
  };

  console.log("ok modifier");
}
function loaduser() {
  var xhttp = new XMLHttpRequest();
  var nom = document.getElementById("nom1");
  var prenom = document.getElementById("prenom1");
  var mail = document.getElementById("mail1");
  var mdp = document.getElementById("mdp1");
  var type = document.getElementById("type1");
  var id = document.getElementById("id");
  var button = document.getElementById("loaduser");
  var id1 = id.value;

  button.className = "spinner-border spinner text-warning spi";

  xhttp.open("POST", "/Dashbord/utilisateur_sql.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      button.className = "spinner-border spinner text-light spi";
    }
  };
  xhttp.send("id=" + id1 + "&mode=2");

  xhttp.onload = function () {
    const resulHtml = xhttp.responseText;
    res = setInterval(() => {
      var result = resulHtml.split("[");
      var result1 = result[1].split("]");
      var result = JSON.parse(result1[0]);

      console.log(result);

      if (resulHtml) {
        if (parseInt(result1[1]) == 1) {
          button = document.getElementById("loaduser");
          res1 = setInterval(() => {
            button.className = "";
            clearInterval(res);
            clearInterval(res1);
          }, 1000);
          button.className = "spinner-border spinner text-success spi";
          nom.value = result.nom;
          prenom.value = result.prenom;
          mail.value = result.mail;
          mdp.value = result.mdp;
          type.value = result.type;
          clearInterval(res);
          console.log(parseInt(result1[1]));
        }
        if (parseInt(result1[1]) == 0) {
          button.className = "spinner-border spinner text-danger spi";
        }
      }
    }, 2000);
  };
}
function supp(id) {
  var xhttp = new XMLHttpRequest();
  var button = document.getElementById("supp");

  button.className = "spinner-border spinner text-warning spi";

  xhttp.open("POST", "/Dashbord/utilisateur_sql.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      button.className = "spinner-border spinner text-light spi";
    }
  };
  xhttp.send("id=" + id + "&mode=3");

  xhttp.onload = function () {
    const resulHtml = xhttp.responseText;
    res = setInterval(() => {
      console.log(resulHtml);
      if (resulHtml) {
        if (parseInt(resulHtml) == 1) {
          button = document.getElementById("supp");
          res1 = setInterval(() => {
            button.className = "";
            clearInterval(res);
            clearInterval(res1);
            window.location.reload();
          }, 1000);
          button.className = "spinner-border spinner text-success spi";
          clearInterval(res);
          console.log(parseInt(resulHtml));
        }
        if (parseInt(resulHtml) == 0) {
          button.className = "spinner-border spinner text-danger spi";
        }
      }
    }, 2000);
  };
}
function AffichieruserMenu() {
  const id = document.getElementById("USER");
  const menu = document.getElementById("idusers");
  menu.innerHTML = "";
  const reponce = request(
    "SHOW",
    "/Dashbord/utilisateur_sql.php",
    `searcheUser=${id.value}&Afficher=True`
  );
  reponce.then((value) => {
    console.log(value);
    menu.innerHTML = value;
  });
}

function delFill() {
  const delFillHTML = document.getElementById("delFillHTML");
  const delFillCOL = document.getElementById("delFillCOL");
  console.log(delFillHTML.value, delFillCOL.value);

  const reponce = request(
    "DELFIL",
    "/Dashbord/utilisateur_sql.php",
    `searcheUser=${
      USER.value
    }&ColoneName=${delFillCOL.value.toString()}&FileName=${delFillHTML.value.toString()}`
  );
}
function addFill() {
  const selectId2 = document.getElementById("addFile2");
  const selectId3 = document.getElementById("addFile3");
  console.log(selectId2.value, selectId3.value);
  const USER = document.getElementById("USER");
  const reponce = request(
    "ADDFIL",
    "/Dashbord/utilisateur_sql.php",
    `searcheUser=${
      USER.value
    }&ColoneName=${selectId2.value.toString()}&FileName=${selectId3.value.toString()}`
  );
}

function addColone() {
  const ColoneId2 = document.getElementById("addColone");
  console.log(ColoneId2.value);
  const USER = document.getElementById("USER");

  //menu.innerText = "";

  const reponce = request(
    "POST",
    "/Dashbord/utilisateur_sql.php",
    `searcheUser=${USER.value}&AjouterColoneName=${ColoneId2.value.toString()}`
  );

  reponce.then((value) => {
    //menu.innerHTML = value;
    //console.log(value);
  });
}
function DELColone() {
  const ColoneId2 = document.getElementById("DELColone");
  console.log(ColoneId2.value);
  const USER = document.getElementById("USER");
  const reponce = request(
    "DELETE",
    "/Dashbord/utilisateur_sql.php",
    `searcheUser=${
      USER.value
    }&DelletAjouterColoneName=${ColoneId2.value.toString()}`
  );
}
