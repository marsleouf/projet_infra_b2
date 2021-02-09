function request(type, url, value = "") {
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
      let resJson1 = JSON.parse(xhttp.responseText);
      console.log(resJson1);
      affchiffe(resJson1);
    }
  };
}
res = setInterval(() => {
  request("POST", "/Dashbord/API/APIPlex.php", "play=play");
}, 3000);
function affchiffe(data) {
  let name_user = document.getElementById("name_user");
  let media_event = document.getElementById("media_event");
  name_user.innerText = data.Account.title;
  media_event.innerText = data.event;
}
