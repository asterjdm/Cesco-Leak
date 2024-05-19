async function getAllComments() {
  let response = await fetch("api/getAllComments.php");
  let responseJson = await response.json();
  return responseJson;
}
