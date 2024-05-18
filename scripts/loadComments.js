function loadComments(comments) {
  const commentsEmp = document.getElementById("commentsPlace");
  commentsEmp.innerHTML =
    "<p>Il n'y a pas de commentaires pour le moment...</p>";
  let commentsHtml = "";

  for (let i = 0; i < comments.length; i++) {
    commentsHtml += /*html*/ `
    <div class="message">
        <p class="user"><i>USER#${comments[i].IP.match(/\d/g)
          .join("")
          .slice(0, 6)}:</i></p>
        <p>${comments[i].content}</p>
    </div>
    `;
  }

  if (comments.length >= 1) {
    commentsEmp.innerHTML = commentsHtml;
  }
}
