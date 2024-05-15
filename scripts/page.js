const imageInput = document.getElementById('uploadPhoto');
const previewImage = document.getElementById('previewImage');
const standardPopupContentMessages = document.getElementById('standardPopupContentMessages')

const ratingValues = document.querySelectorAll(".value");
const ratingTexts = document.querySelectorAll(".score-value p");

ratingValues.forEach((value, index) => {
    value.addEventListener("input", function() {
        ratingTexts[index].textContent = this.value;
    });
});

imageInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        previewImage.src = '#';
    }
});

window.onload = function() {
    standardPopupContentMessages.scrollTop = standardPopupContentMessages.scrollHeight;
};
