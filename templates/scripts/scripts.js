const imageInput = document.getElementById('uploadPhoto');
const previewImage = document.getElementById('previewImage');
const standardPopupCotentMessages = document.getElementById('standardPopupCotentMessages')

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
    standardPopupCotentMessages.scrollTop = standardPopupCotentMessages.scrollHeight;
};
