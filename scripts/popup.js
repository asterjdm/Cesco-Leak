function openPopup(id) {
  const popup = document.getElementById(id);
  popup.classList.add("show");
  // localStorage.setItem("openPopupId", id);
}

function openRatingPopup(popupId, profId) {
  openPopup(popupId);

  const voteRatingButton = document.getElementById("voteRatingButton");
  voteRatingButton.addEventListener("click", () => {
    sendVotes(
      profId,
      parseFloat(document.getElementById("ratingTeachingQuality").value),
      parseFloat(document.getElementById("ratingKindness").value),
      parseFloat(document.getElementById("ratingAuthority").value),
      parseFloat(document.getElementById("ratingHumor").value)
    ).then(() => {
      closePopup(popupId);
    });
  });
}

function closePopup(id) {
  const popup = document.getElementById(id);
  popup.classList.add("closing");
  setTimeout(() => {
    popup.classList.remove("show", "closing");
  }, 250);
  // localStorage.removeItem("openPopupId");
}

// document.addEventListener("DOMContentLoaded", function () {
//   const openPopupId = localStorage.getItem("openPopupId");
//   if (openPopupId) {
//     openPopup(openPopupId);
//   }
// });

document.addEventListener("keydown", function (event) {
  if (event.key === "Escape") {
    const popups = document.querySelectorAll(".show");
    popups.forEach(function (popup) {
      closePopup(popup.id);
    });
  }
});
