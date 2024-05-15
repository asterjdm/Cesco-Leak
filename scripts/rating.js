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

  if (response.json().info == "vote updated") {
    alert("Votre vote a été mis a jour");
  }
}
