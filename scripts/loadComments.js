function loadComments(comments) {
  const commentsEmp = document.getElementById("commentsPlace");
  commentsEmp.innerHTML = "";
  let commentsHtml = "";

  for (let i = 0; i < comments.length; i++) {
    commentsHtml += /*html*/ `
    <div class="message">
        <p class="user">39273</p>
        <p>${comments[i].content}</p>
    </div>
    `;
  }

  commentsEmp.innerHTML = commentsHtml;
}
