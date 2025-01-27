// Selección de elementos
const menuToggle = document.querySelector('.menu-toggle');
const menu = document.querySelector('.menu');

// Alternar clase active al hacer clic en el botón
menuToggle.addEventListener('click', () => {
  menu.classList.toggle('active');
});
