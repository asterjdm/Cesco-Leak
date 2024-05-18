async function getBann() {
  let response = await fetch("api/isBanned.php");
  let responseJson = await response.json();
  return responseJson.banned ? responseJson : false;
}
