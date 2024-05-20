async function sendVotes(profId, teachingQuality, kindness, humor) {
  let response = await fetch("api/newRating.php", {
    method: "POST",
    body: objectToFormData({
      teacherId: profId,
      teachingQuality: teachingQuality,
      kindness: kindness,
      humor: humor,
    }),
  });
  let responseJson = await response.json();
  if (responseJson.info == "vote updated") {
    openPopup("alertPopup");
  }
}
