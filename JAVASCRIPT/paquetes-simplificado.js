// Función para mostrar el PDF correspondiente al hacer clic en los botones
function mostrarPDF(pdfID) {
    // Primero, ocultar todos los iframes
    const iframes = document.querySelectorAll('.pdf-container');
    iframes.forEach(function(iframe) {
        iframe.style.display = 'none';
    });

    // Luego, mostrar solo el iframe correspondiente
    const iframeToShow = document.getElementById(pdfID);
    if (iframeToShow) {
        iframeToShow.style.display = 'block';
    }
}

// Función para cerrar los iframes (ocultarlos)
function cerrarPDF() {
    // Ocultar todos los iframes
    const iframes = document.querySelectorAll('.pdf-container');
    iframes.forEach(function(iframe) {
        iframe.style.display = 'none';
    });
}
