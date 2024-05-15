const profCardsEmp = document.getElementById("profCards");
var htmlResult = "";

function getStarsHtml(n) {
  let starsHtml = "";
  for (let i = 0; i < n; i++) {
    starsHtml += "<label></label>";
  }
  return starsHtml;
}

getTeachers().then(function (teachers) {
  console.log(teachers);
  teachers.forEach((teacher) => {
    console.log(teacher);
    htmlResult += `
    <div class='standard-card'>
      <div class="standard-card-top">
        <img
          class="standard-card-image"
          src="${teacher.image_url}"
          alt="undefined"
        />
        <div class="standard-card-top-right">
          <h1 class="standard-card-name">${teacher.name}</h1>
          <button
            class="standard-button standard-card-top-right-button"
            onclick="openPopup('ratingPopup')"
          >
            Voter
          </button>
        </div>
      </div>

      <div class="standard-card-stars-container">
        <p class="standart-card-stars-text">Moyenne</p>

        <div class="standard-card-stars">
          ${getStarsHtml(
            Math.round(
              (teacher.teaching_quality +
                teacher.kindness +
                teacher.authority +
                teacher.humor) /
                4
            )
          )}
        </div>

        <p class="standart-card-stars-text">Autorité</p>
        <div class="standard-card-stars">
          ${getStarsHtml(teacher.authority)}
        </div>

        <p class="standart-card-stars-text">Humour</p>
        <div class="standard-card-stars">${getStarsHtml(teacher.humor)}</div>

        <p class="standart-card-stars-text">Qualité d'enseignement</p>
        <div class="standard-card-stars">
          ${getStarsHtml(teacher.teaching_quality)}
        </div>

        <p class="standart-card-stars-text">Gentilesse</p>
        <div class="standard-card-stars">${getStarsHtml(teacher.kindness)}</div>
      </div>
      <!-- Open comments popup -->
      <div
        class="standard-button standard-card-button"
        onclick="openPopup('commentPopup')"
      >
        Lire les avis
      </div>
    </div>
    `;
  });

  profCardsEmp.innerHTML = htmlResult;
});
