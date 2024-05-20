getBann().then((result) => {
  if (result.banned != true) {
    window.location.href = "index.html";
  }
  setInterval(() => {
    let unbannTime = (result.end_date - Math.floor(Date.now() / 1000)) * 1;
    let hours = unbannTime / 3600;
    let minutes = (hours - Math.floor(hours)) * 60;
    let seconds = (minutes - Math.floor(minutes)) * 60;

    if (unbannTime < 0) {
      window.location.href = "index.html";
    }

    document.getElementById(
      "bannedTime"
    ).innerText = `Vous allez être réintégré dans ${Math.floor(
      hours
    )} heures, ${Math.floor(minutes)} minutes et ${Math.round(
      seconds
    )} secondes`;
  }, 100);
});
