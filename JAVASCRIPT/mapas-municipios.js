document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".municipio_btn");
    const iframes = document.querySelectorAll("#iframes-container iframe");
    const defaultMap = document.getElementById("default-map"); // Iframe por defecto
    const iframesContainer = document.getElementById("iframes-container"); // Contenedor de los iframes

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            // Ocultar el iframe por defecto
            if (defaultMap) {
                defaultMap.style.display = "none";
            }

            // Ocultar todos los iframes adicionales
            iframes.forEach(iframe => iframe.style.display = "none");

            // Mostrar el iframe correspondiente
            const municipio = button.getAttribute("data-municipio");
            const iframeToShow = document.getElementById(municipio);
            if (iframeToShow) {
                iframeToShow.style.display = "block";
            }

            // Desplazarse al contenedor de los mapas
            if (iframesContainer) {
                iframesContainer.scrollIntoView({ behavior: "smooth" }); // Animación suave
            }
        });
    });
});
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".button-requisitos");

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            // Obtener el id de la sección objetivo desde el atributo data-target
            const targetId = button.getAttribute("data-target");
            const targetSection = document.querySelector(`.${targetId}`);

            if (targetSection) {
                // Desplazarse suavemente a la sección objetivo
                targetSection.scrollIntoView({ behavior: "smooth" });
            } else {
                console.error(`No se encontró la sección con clase: ${targetId}`);
            }
        });
    });
});
