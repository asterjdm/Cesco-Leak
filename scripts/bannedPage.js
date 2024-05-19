getBann().then((result) => {
  console.log(result);
  let unbannTime = (result.end_date - Math.floor(Date.now() / 1000)) * 1;
  document.getElementById(
    "bannedTime"
  ).innerText = `Vous allez être réintégré dans ${unbannTime / 3600} heurs`;
});
