function openRatingPopup(teacherId) {
  document.getElementById("teacherIdInput").value = teacherId;
  document.getElementById("ratingPopup").classList.remove("popup-hidden");
}

function closeRatingPopup() {
  document.getElementById("ratingPopup").classList.add("popup-hidden");
}
