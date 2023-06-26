document.addEventListener('DOMContentLoaded', () => {
  const contentContainers = Array.from(document.querySelectorAll('.content'));
  const prevButtons = Array.from(document.querySelectorAll('.before'));
  const nextButtons = Array.from(document.querySelectorAll('.next'));

  const totalContainers = contentContainers.length;
  let currentIndex = 0;

  nextButtons.forEach((nextButton) => {
    nextButton.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % totalContainers;
      moveSlider();
    });
  });

  prevButtons.forEach((prevButton) => {
    prevButton.addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + totalContainers) % totalContainers;
      moveSlider();
    });
  });

  function moveSlider() {
    contentContainers.forEach((container, index) => {
      if (index === currentIndex) {
        container.classList.add('active');
      } else {
        container.classList.remove('active');
      }
    });
  }
});
