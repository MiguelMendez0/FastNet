function actualizarMunicipios() {
    // Obtener el valor del estado seleccionado
    const estado = document.getElementById('estado').value;
    const municipioSelect = document.getElementById('municipio');
    
    // Limpiar los municipios previos
    municipioSelect.innerHTML = '<option value="">Selecciona</option>';
  
    // Datos de municipios por estado
    const municipios = {
      CAMPECHE: ['CIUDAD DEL CARMEN'],
      CHIAPAS: ['PICHUCALCO'],
      COAHUILA: ['ALLENDE', 'MORELOS'],
      CHIHUAHUA: ['DELICIAS', 'PEDRO MEOQUI', 'SANTA CRUZ DE ROSALES'],
      TABASCO: ['CENTRO', 'COMALCALCO', 'JALAPA', 'JALPA DE MENDEZ', 'NACAJUCA', 'PARAISO', 'TACOTALPA', 'TEAPA']
    };
  
    // Si el estado seleccionado tiene municipios, agregar opciones
    if (municipios[estado]) {
      municipios[estado].forEach(municipio => {
        const option = document.createElement('option');
        option.value = municipio;
        option.textContent = municipio;
        municipioSelect.appendChild(option);
      });
    }
  }