// Creamos un objeto para guardar las comandas que van llegando, organizadas por su ID.
// Así podemos tener varias comandas activas a la vez sin que se mezclen.
const comandasPorId = {};

const datosGuardados = localStorage.getItem('comandasCocina');
if (datosGuardados) {
  const datos = JSON.parse(datosGuardados);
  Object.assign(comandasPorId, datos); // Copia los datos al objeto actual
  mostrarComandasCocina(comandasPorId); // Los muestra al arrancar
}

// Nos conectamos al servidor WebSocket que corre en el puerto 8080 en local.
// Esto es lo que nos permite recibir las comandas en tiempo real.
const socket = new WebSocket('ws://localhost:8080');

// Cuando la conexión se abre correctamente...
socket.addEventListener('open', () => {
  console.log('Conectado al WebSocket');
  
  // Le enviamos un mensaje al servidor para decirle que esta parte del programa es la "barra".
  // Así el servidor sabe a quién tiene que mandar las comandas.
  socket.send(JSON.stringify({ tipo: 'identificacion', categoria: 'cocina' }));
});

// Cada vez que recibimos un mensaje del servidor...
socket.addEventListener('message', (event) => {
  console.log('Mensaje recibido raw:', event.data);

  try {
    // Intentamos convertir ese mensaje (que viene en texto plano) a un objeto JSON.
    const data = JSON.parse(event.data);
    console.log('Mensaje parseado:', data);

    // Si el mensaje es para la barra, y viene con una comanda que es un array con al menos una línea...
    if (data.tipo === 'cocina' && Array.isArray(data.comanda) && data.comanda.length > 0) {
      
      // Cogemos el ID de la comanda desde la primera línea (todas las líneas tienen el mismo ID).
      const idComanda = data.comanda[0].id_comanda;
      
      // Guardamos esa comanda en el objeto, usando su ID como clave.
      // Así, si llega otra con el mismo ID, se actualiza.
      comandasPorId[idComanda] = data.comanda;

       

      // Llamamos a una función que se encarga de mostrar en pantalla todas las comandas.
      mostrarComandasCocina(comandasPorId);
    
    } else {
      // Si el mensaje no era para barra, lo avisamos por consola.
      console.log('No es “cocina”, es:', data.tipo);
    }

  } catch (e) {
    // Si algo sale mal al intentar parsear el JSON, mostramos el error.
    console.error('Error parseando JSON:', e);
  }
});

// Cuando se cierra la conexión con el servidor...
socket.addEventListener('close', () => {
  console.log('Desconectado del WebSocket');
});

// Si hay algún error en la conexión WebSocket, lo mostramos por consola.
socket.addEventListener('error', (err) => {
  console.error('Error WebSocket:', err);
});




// Esta función es la que pinta las comandas en el contenedor de la barra (HTML).
// Recibe un objeto donde cada clave es un ID de comanda, y su valor es un array con las líneas de esa comanda.
function mostrarComandasCocina(comandasObj) {
  // Pillamos el contenedor del HTML donde se van a meter todas las comandas.
  const container = document.getElementById('comandas-cocina');

  // Limpiamos el contenedor antes de meter nuevas comandas, así no se repite todo.
  container.innerHTML = '';

  // Recorremos todas las comandas que nos llegan (cada una con su ID y sus líneas/productos).
  for (const [idComanda, lineas] of Object.entries(comandasObj)) {
    
    // Creamos un div para hacer la "tarjeta" de cada comanda.
    const card = document.createElement('div');
    // Le metemos estilos chulos con clases de Bootstrap para que tenga sombra, bordes redondeados, etc.
    card.className = 'card shadow-lg border-0 rounded-4 mb-4 bg-light';

    // Esto es el encabezado de la tarjeta, donde ponemos el número de comanda.
    const header = `
      <div class="card-header bg-dark text-white fw-bold">
        🧾 Comanda #${idComanda}
      </div>
    `;

    // Ahora preparamos el cuerpo (body) de la tarjeta, que será una tabla.
    let cuerpo = `
      <div class="card-body p-3">
        <div class="table-responsive">
          <table class="table table-hover align-middle text-center">
            <thead class="table-light">
              <tr>
              <th scope="col">Seleccionar</th>
                <th scope="col">🍽 Producto</th>
                <th scope="col">🔢 Unidades</th>
                <th scope="col">📝 Observaciones</th>
              </tr>
            </thead>
            <tbody>
    `;

    // Recorremos cada línea (producto) de la comanda.
    lineas.forEach(linea => {
      cuerpo += `
        <tr>
          <td><input type="checkbox" class="check-linea" data-id_linea="${linea. id_lineacomanda}" value="${linea. id_lineacomanda}" ></td>
          <td>${linea.nombre_producto}</td>
          <td>${linea.unidades}</td>
          <td>${linea.descripcion_producto || 'Ninguna'}</td>
        </tr>
      `;
    });

    // Cerramos la tabla y el resto del HTML.
    cuerpo += `
            </tbody>
          </table>
        </div>
        <div class="container-fluid d-flex justify-content-center gap-2">
              <button class="btn btn-outline-warning" id="btn-en-cola">En Cola</button>
              <button class="btn btn-outline-danger" id="btn-preparando">Preparando</button>
              <button class="btn btn-outline-success"  id="btn-finalizado">Finalizado</button>
        </div>
      </div>
    `;

    // Metemos el HTML del header y del body dentro de la tarjeta.
    card.innerHTML = header + cuerpo;

    // Y por último, añadimos la tarjeta al contenedor principal para que aparezca en pantalla.
    container.appendChild(card);
  }
}

//Apartado de cambio de estado 

document.getElementById('comandas-cocina').addEventListener('click', (event) => {
  if (['btn-en-cola', 'btn-preparando', 'btn-finalizado'].includes(event.target.id)) {
    let nuevoEstado;

    switch(event.target.id) {
      case 'btn-en-cola':
         nuevoEstado = 'cola';
          break;
      case 'btn-preparando': 
      nuevoEstado = 'preparando';
       break;
      case 'btn-finalizado': 
      nuevoEstado = 'finalizado'; 
      break;
    }

    // Recogemos todos los checkboxes seleccionados
    const checkboxes = document.querySelectorAll('.check-linea:checked');

    if (checkboxes.length === 0) {
      alert('Selecciona al menos una línea para cambiar el estado.');
      return;
    }

    // Obtenemos los ids de las líneas seleccionadas
    const idsSeleccionados = Array.from(checkboxes).map(chk => chk.value);

    console.log('Cambiar estado a:', nuevoEstado, 'en líneas:', idsSeleccionados);

    // Aquí pones tu lógica para cambiar el estado, por ejemplo enviar por WebSocket
    // socket.send(JSON.stringify({ tipo: 'cambiar_estado', ids: idsSeleccionados, estado: nuevoEstado }));

    // También puedes actualizar localmente o llamar a otra función que refresque la UI.
  }
});


