const socket = new WebSocket('ws://localhost:8080');

    socket.addEventListener('open', () => {
      console.log('Conectado al WebSocket');
    });

    socket.addEventListener('message', (event) => {
      console.log('Mensaje recibido raw:', event.data);
      try {
        const data = JSON.parse(event.data);
        console.log('Mensaje parseado:', data);
        if (data.tipo === 'barra') {
          mostrarComandasBarra(data.comanda);
        } else {
          console.log('No es “barra”, es:', data.tipo);
        }
      } catch (e) {
        console.error('Error parseando JSON:', e);
      }
    });

    socket.addEventListener('close', () => {
      console.log('Desconectado del WebSocket');
    });

    socket.addEventListener('error', (err) => {
      console.error('Error WebSocket:', err);
    });

    function mostrarComandasBarra(comandas) {
      const container = document.getElementById('comandas-barra');
      if (!Array.isArray(comandas) || comandas.length === 0) {
        container.innerHTML = `<div class="text-muted text-center">No hay comandas por el momento.</div>`;
        return;
      }
      container.innerHTML = ''; // limpiar

      comandas.forEach(linea => {
        const card = document.createElement('div');
        card.className = 'card mb-2 shadow-sm bg-light text-dark';
        card.innerHTML = `
          <div class="card-body p-2">
            <h6 class="card-title mb-1">${linea.nombre_producto}</h6>
            <p class="card-text mb-0"><strong>Cantidad:</strong> ${linea.unidades}</p>
            <p class="card-text"><small class="text-muted">Obs: ${linea.descripcion_producto || 'Ninguna'}</small></p>
          </div>`;
        container.appendChild(card);
      });
    }