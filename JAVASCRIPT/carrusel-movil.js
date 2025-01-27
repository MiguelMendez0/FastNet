document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.mobile-carousel-open'); // Todos los inputs radio
    const nextButton = document.querySelector('.mobile-carousel-control.next'); // Botón siguiente
    const prevButton = document.querySelector('.mobile-carousel-control.prev'); // Botón anterior
    let currentIndex = 0; // Índice actual del carrusel
  
    // Función para avanzar al siguiente slide
    function goToNextSlide() {
      // Desmarcar el radio actual
      slides[currentIndex].checked = false;
      // Avanzar al siguiente, si estamos en el último, volvemos al primero
      currentIndex = (currentIndex + 1) % slides.length;
      // Marcar el siguiente radio
      slides[currentIndex].checked = true;
    }
  
    // Función para retroceder al slide anterior
    function goToPrevSlide() {
      // Desmarcar el radio actual
      slides[currentIndex].checked = false;
      // Retroceder al anterior, si estamos en el primero, vamos al último
      currentIndex = (currentIndex - 1 + slides.length) % slides.length;
      // Marcar el radio anterior
      slides[currentIndex].checked = true;
    }
  
    // Eventos para los botones de control
    nextButton.addEventListener('click', goToNextSlide);
    prevButton.addEventListener('click', goToPrevSlide);
  });
  