let xhttp = new XMLHttpRequest();
xhttp.open("GET", "/Dashbord/objet_sql.php?AllStatus=prise", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.onreadystatechange = function () {
  //   if (this.readyState == 4 && this.status == 200) {
  //     button.className = "spinner-border spinner text-light spi";
  //   }
};
xhttp.send();
xhttp.onload = function () {
  const resulHtml = xhttp.responseText;
  //console.log(resulHtml);
  try {
    obj = JSON.parse(resulHtml);
    let id;
    //console.log(obj);
    for (const [key, value] of Object.entries(obj)) {
      for (const [key1, value1] of Object.entries(value)) {
        //console.log(key1, value1);

        if (key1 == "error") {
          let errorId = document.getElementById(`${id}error`);
          errorId.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ${value1}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`;
        }
        if (key1 == "data") {
          if (value1 != null) {
            for (const [key2, value2] of Object.entries(value1)) {
              //console.log(`${id}${key2}`);
              let statusid = document.getElementById(`${id}${key2}`);
              if (value2) {
                statusid.className = "badge badge-success";
              } else {
                statusid.className = "badge badge-danger";
              }
            }
          }
        } else {
          id = value1;
        }
      }
    }
  } catch (err) {
    console.error("load error" + err.message);
  }
};

function btnprise(id, idAction, status) {
  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "/Dashbord/objet_sql.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function () {
    //   if (this.readyState == 4 && this.status == 200) {
    //     button.className = "spinner-border spinner text-light spi";
    //   }
  };
  xhttp.send("id=" + id + "&idAction=" + idAction + "&status=" + status);
  xhttp.onload = function () {
    const resulHtml = xhttp.responseText;
    //console.log(resulHtml);
    try {
      obj = JSON.parse(resulHtml);
      console.log(obj);
      let idobjet = obj.id;
      let data = obj.data;
      for (const [key, value] of Object.entries(data)) {
        let statusid = document.getElementById(`${idobjet}${key}`);
        if (value) {
          statusid.className = "badge badge-success";
        } else {
          statusid.className = "badge badge-danger";
        }
      }
    } catch (err) {
      console.error("load error" + err.message);
    }
  };
}
