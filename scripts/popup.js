function openPopup(id) {
  document.body.style.overflow = 'hidden';
  const popup = document.getElementById(id);
  popup.classList.add("show");
  localStorage.setItem("openPopupId", id)

}

function recreateNode(el, withChildren) {
  if (withChildren) {
    el.parentNode.replaceChild(el.cloneNode(true), el);
  } else {
    var newEl = el.cloneNode(false);
    while (el.hasChildNodes()) newEl.appendChild(el.firstChild);
    el.parentNode.replaceChild(newEl, el);
  }
}

function openRatingPopup(popupId, profId) {
  openPopup(popupId);

  recreateNode(document.getElementById("voteRatingButton"), true);

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
      getTeachers(
        document.getElementById("searchBar").value,
        document.getElementById("sortTeachers").value
      ).then(function (teachers) {
        addTeachers(teachers);
      });
    });
  });
}

function onCommentSend(profId) {
  sendComment(
    document.getElementById("commentContentInput").value,
    profId
  ).then(() => {
    getComments(profId).then(function (comments) {
      loadComments(comments);
    });
    document.getElementById("commentContentInput").value = "";
  });
}

function openCommentsPopup(popupId, profId) {
  openPopup(popupId);

  getComments(profId).then(function (comments) {
    loadComments(comments);
  });

  recreateNode(document.getElementById("commentPopup"), true);

  const sendCommentButton = document.getElementById("sendCommentButton");
  const sendCommentInput = document.getElementById("commentContentInput");

  sendCommentInput.addEventListener("keyup", function (e) {
    if (e.key == "Enter") {
      onCommentSend(profId);
    }
  });

  sendCommentButton.addEventListener("click", () => onCommentSend(profId));
}

function closePopup(id) {
  const popup = document.getElementById(id);
  popup.classList.add("closing");
  setTimeout(() => {
    popup.classList.remove("show", "closing");
  }, 250);
  document.body.style.overflow = 'auto';
  localStorage.removeItem("openPopupId");
}

document.addEventListener("DOMContentLoaded", function () {
  const openPopupId = localStorage.getItem("openPopupId");
  if (openPopupId) {
    openPopup(openPopupId);
  }
});

document.addEventListener("keydown", function (event) {
  if (event.key === "Escape") {
    const popups = document.querySelectorAll(".show");
    popups.forEach(function (popup) {
      closePopup(popup.id);
    });
  }
});
