async function sendVotes(profId, teachingQuality, kindness, authority, humor) {
  const formData = new FormData();

  let response = await fetch("api/newRating.php", {
    method: "POST",
    body: objectToFormData({
      teacherId: profId,
      teachingQuality: teachingQuality,
      kindness: kindness,
      authority: authority,
      humor: humor,
    }),
  });
  let responseJson = await response.json();
  console.log(responseJson);
  if (responseJson.info == "vote updated") {
    alert("Votre vote a été mis a jour");
  }
}
