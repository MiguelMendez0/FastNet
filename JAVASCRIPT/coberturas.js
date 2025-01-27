// Función para cerrar todas las secciones
function cerrarTodasLasSecciones() {
    const secciones = document.querySelectorAll('.hidden-tabasco, .hidden-campeche, .hidden-chiapas, .hidden-chihuahua, .hidden-coahuila');
    secciones.forEach(seccion => {
        seccion.style.display = 'none';
    });
}

// BOTON COBERTURA TABASCO
const botonTabasco = document.getElementById('boton-tabasco');
if (botonTabasco) {
    botonTabasco.addEventListener('click', function() {
        const seccionMunicipios = document.querySelector('.hidden-tabasco');
        if (seccionMunicipios) {
            if (seccionMunicipios.style.display === 'block') {
                seccionMunicipios.style.display = 'none'; // Oculta la sección si ya está visible
            } else {
                cerrarTodasLasSecciones(); // Cierra todas las secciones
                seccionMunicipios.style.display = 'block'; // Muestra la sección de Tabasco
            }
        }
    });
}

// BOTON COBERTURA CAMPECHE
const botonCampeche = document.getElementById('boton-campeche');
if (botonCampeche) {
    botonCampeche.addEventListener('click', function() {
        const seccionMunicipios = document.querySelector('.hidden-campeche');
        if (seccionMunicipios) {
            if (seccionMunicipios.style.display === 'block') {
                seccionMunicipios.style.display = 'none'; // Oculta la sección si ya está visible
            } else {
                cerrarTodasLasSecciones(); // Cierra todas las secciones
                seccionMunicipios.style.display = 'block'; // Muestra la sección de Campeche
            }
        }
    });
}

// BOTON COBERTURA CHIAPAS
const botonChiapas = document.getElementById('boton-chiapas');
if (botonChiapas) {
    botonChiapas.addEventListener('click', function() {
        const seccionMunicipios = document.querySelector('.hidden-chiapas');
        if (seccionMunicipios) {
            if (seccionMunicipios.style.display === 'block') {
                seccionMunicipios.style.display = 'none'; // Oculta la sección si ya está visible
            } else {
                cerrarTodasLasSecciones(); // Cierra todas las secciones
                seccionMunicipios.style.display = 'block'; // Muestra la sección de Chiapas
            }
        }
    });
}

// BOTON COBERTURA CHIHUAHUA
const botonChihuahua = document.getElementById('boton-chihuahua');
if (botonChihuahua) {
    botonChihuahua.addEventListener('click', function() {
        const seccionMunicipios = document.querySelector('.hidden-chihuahua');
        if (seccionMunicipios) {
            if (seccionMunicipios.style.display === 'block') {
                seccionMunicipios.style.display = 'none'; // Oculta la sección si ya está visible
            } else {
                cerrarTodasLasSecciones(); // Cierra todas las secciones
                seccionMunicipios.style.display = 'block'; // Muestra la sección de Chihuahua
            }
        }
    });
}

// BOTON COBERTURA COAHUILA
const botonCoahuila = document.getElementById('boton-coahuila');
if (botonCoahuila) {
    botonCoahuila.addEventListener('click', function() {
        const seccionMunicipios = document.querySelector('.hidden-coahuila');
        if (seccionMunicipios) {
            if (seccionMunicipios.style.display === 'block') {
                seccionMunicipios.style.display = 'none'; // Oculta la sección si ya está visible
            } else {
                cerrarTodasLasSecciones(); // Cierra todas las secciones
                seccionMunicipios.style.display = 'block'; // Muestra la sección de Coahuila
            }
        }
    });
}
