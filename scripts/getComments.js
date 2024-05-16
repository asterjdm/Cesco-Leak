async function getComments(profId) {
  let response = await fetch("api/getComments.php", {
    method: "POST",
    body: objectToFormData({
      teacherID: profId,
    }),
  });
  let responseJson = await response.json();
  return responseJson;
}
