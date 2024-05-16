function loadComments(comments) {
  const commentsEmp = document.getElementById("commentsPlace");
  commentsEmp.innerHTML = "";
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

  commentsEmp.innerHTML = commentsHtml;
}
