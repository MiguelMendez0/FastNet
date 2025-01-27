document.addEventListener('DOMContentLoaded', function() {
  let currentIndex = 0;

  function moveSlider(direction) {
    const slider = document.querySelector('.slider');
    const items = document.querySelectorAll('.plan-item');
    const totalItems = items.length;

    if (direction === 'next') {
      currentIndex = (currentIndex + 1) % totalItems;
    } else if (direction === 'prev') {
      currentIndex = (currentIndex - 1 + totalItems) % totalItems;
    }

    const slideWidth = items[0].offsetWidth;
    slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
  }

  // Seleccionar el botón y agregar el evento
  const nextButton = document.querySelector('.slider-next');
  if (nextButton) {
    nextButton.addEventListener('click', function() {
      moveSlider('next');
    });
  }
});
