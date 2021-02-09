var nameSpotify = document.getElementById("spotify").dataset.spotify;
let uri = document.location.href.split("?");
let Uri_redre = uri[0];
console.log(Uri_redre);
//console.log(nbPage[1]);
var player;
var spotify = new MySpotify();
var token = spotify.Authorization();
let time_status = true;
window.onSpotifyWebPlaybackSDKReady = () => {
  //volume.addEventListener("change", vol, false);

  //spotify = new Spotify
  player = new Spotify.Player({
    name: `Dashboard ${nameSpotify}`,
    getOAuthToken: (cb) => {
      cb(spotify.getToken());
    },
  });

  // Error handling
  player.addListener("initialization_error", ({ message }) => {
    console.error(message);
  });
  player.addListener("authentication_error", ({ message }) => {
    console.error(message);
    document.location.href = Uri_redre;
  });
  player.addListener("account_error", ({ message }) => {
    console.error(message);
  });
  player.addListener("playback_error", ({ message }) => {
    console.error(message);
  });

  // Playback status updates
  player.addListener("player_state_changed", (state) => {
    console.log(state);
  });

  // Ready
  player.addListener("ready", ({ device_id }) => {
    console.log("Ready with Device ID", device_id);
  });
  // Not Ready
  player.addListener("not_ready", ({ device_id }) => {
    console.log("Device ID has gone offline", device_id);
  });

  player.getVolume().then((volume) => {
    let volume_percentage = volume * 100;
    console.log(`The volume of the player is ${volume_percentage}%`);
  });

  // Connect to the player!
  player.connect();
  console.log(spotify.getToken());
  spotify.getDevice();
  spotify.playerDevice();
  actualiser();
};
load(true);
function bntnext() {
  spotify.nextDevice();
  actualiser();
}
function bntprevious() {
  spotify.prevDevice();
  actualiser();
}
function bntplay() {
  time_status = true;
  load();
  spotify.playDevice();

  actualiser();
}
function bntpause() {
  time_status = false;
  load();
  spotify.pauseDevice();
  actualiser();
}
function device() {
  spotify.getDevice();
}
function showPlayer() {
  var show = spotify.playerDevice();
  console.log(show, "kojsvoisjosijoijdvsoivjsoi");
}
function actualiser(time) {
  var volume_playing = document.getElementById("Volume");
  volume_playing.addEventListener("change", vol, false);
  let time1 = setTimeout(() => {
    spotify.playerDevice();
    spotify.img_alb();
  }, 500);
  console.log(volume_playing.value);
}

function load(time) {
  let time1;
  time1 = setInterval(() => {
    //console.log(time_status);
    if (!time_status) {
      clearInterval(time1);
    } else {
      spotify.playerDevice();
      spotify.img_alb();
      // console.log("dsfsfsdfsfsd");
      spotify.resJson1 = "";
    }
  }, 1000);
}

function vol(event) {
  var volume_playing = document.getElementById("Volume");
  console.log(volume_playing.value);
  spotify.volumeDevice(volume_playing.value);
}
