function displayFilePreview() {
    const input = document.getElementById('cv');
    const fileInfo = document.getElementById('file-info');
    const preview = document.getElementById('file-preview');
    const fileName = document.getElementById('file-name');
    
    const file = input.files[0]; // Obtener el primer archivo
    if (file) {
        // Mostrar el nombre del archivo
        fileName.textContent = `Archivo cargado: ${file.name}`;
        
        // Mostrar el ícono o la miniatura del PDF
        preview.style.display = 'block'; // Hacer visible la miniatura
        preview.src = '../RECURSOS/PDF.png'; // Ícono PDF
    } else {
        preview.style.display = 'none'; // Ocultar la miniatura si no hay archivo
        fileName.textContent = '';
    }
}
