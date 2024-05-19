async function bannComment(id) {
  let password = prompt("ADMIN PASSWORD");
  let userDuration = prompt("Pour combien de temps (Heur) ?");
  let duration = Number(userDuration) * 3600;
  let response = await fetch("api/newBann.php", {
    method: "POST",
    body: objectToFormData({
      comment_id: id,
      password: password,
      duration: duration,
    }),
  });

  let responseJson = await response.json();

  if ("error" in responseJson) {
    alert(responseJson.error);
  } else {
    alert("c'est fait !");
  }
}
