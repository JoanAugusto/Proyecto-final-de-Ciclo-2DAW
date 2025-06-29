// ----------------------------------------------
// formaEvitarRecargaNavegador.js
// ----------------------------------------------

document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('formEnviarComanda');
  if (!form) return;

  form.addEventListener('submit', (e)=> {
    e.preventDefault(); // Evita que se recargue la página

    const formData = new FormData(form);

    // Como 'enviarComandas.php' está en '../js/' respecto a 'templates/resumenComanda.php',
    // necesitamos hacer fetch hacia esa carpeta:
    fetch('../js/enviarComandas.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(texto => {
      console.log('Respuesta de enviarComandas.php:', texto);
      // Aquí  mostramos una alerta o mensaje en pantalla, por ejemplo:
       alert('Comanda enviada correctamente');
    })
    .catch(err => {
      console.error('Error al enviar comanda:', err);
    });
  });
});
