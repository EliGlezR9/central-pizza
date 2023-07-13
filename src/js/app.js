let paso = 1;
const pasoInicial = 1;
const pasoFinal = 4;

//variables para calculo de pedido
let contador = 1;
let precio = 0;
let cantidadPLatillo = 1;
let precioPlatillo = 0;
let precioFinal;

const pedido = {
    nombre: '',
    id: '',
    mesa: '',
    fecha: '',
    hora: '',
    platillos: []
}

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
    
});

function iniciarApp(){

    mostrarSeccion();
    tabs(); //cambia la seccion cuando se preiona tab
    botonesPaginador();
    paginaSiguiente();
    paginaAnterior();

    consultarAPI(); //Consulta la API en el backend

    nombreCliente();
    idCliente();
    seleccionarMesa();
    seleccionarFecha();
    seleccionarHora();
    mostrarResumen();  
}

function mostrarSeccion(){

    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }
    

    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach( boton => {
        boton.addEventListener('click', function(e){
            paso =  parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();
        });

    }) 

}

function botonesPaginador(){
    const paginaSig = document.querySelector('#siguiente');
    const paginaAnt = document.querySelector('#anterior');

    if(paso === 1){
        paginaAnt.classList.add('ocultar');
        paginaSig.classList.remove('ocultar');
    }else if(paso === 3){
        paginaAnt.classList.remove('ocultar');
        paginaSig.classList.add('ocultar');
        mostrarResumen();
    }else{
        paginaAnt.classList.remove('ocultar');
        paginaSig.classList.remove('ocultar');
    }
    mostrarSeccion();
}

function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){
        if(paso >= pasoFinal) return;
        paso++;
        botonesPaginador();
    });
}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){
        if(paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
    });
}

 async function consultarAPI(){

    try {
        const url = 'http://localhost:3000/api/platillos';
        const resultado = await fetch(url);
        const platillos = await resultado.json();
        
        mostrarPlatillos(platillos);
        
    } catch (error) {
        console.log(error); 
    }
}

function mostrarPlatillos(platillos){
    precioFinal;
    contador;
    precio;
    
    platillos.forEach( platillo => {
        const {id, nombre, precio} = platillo;
        
        const nombreplatillo = document.createElement('P');
        nombreplatillo.classList.add('nombre-platillo');
        nombreplatillo.textContent = nombre;

        const precioPlatillo = document.createElement('P');
        precioPlatillo.classList.add('precio-platillo');
        precioPlatillo.textContent = `$${precio}`; 

        const platilloDiv = document.createElement('DIV');
        platilloDiv.classList.add('contenedor-platillo');
        platilloDiv.dataset.idPlatillo = id; 
        platilloDiv.onclick = function(){
            seleccionarPlatillo(platillo);
        }
        
        platilloDiv.appendChild(nombreplatillo);
        platilloDiv.appendChild(precioPlatillo);
        
        document.querySelector('#servicios').appendChild(platilloDiv);
    });
}

function seleccionarPlatillo(platillo){
    const {id} = platillo;
    const { platillos } = pedido;
    const divPlatillo = document.querySelector(`[data-id-platillo="${id}"]`);

    if( platillos.some( agregado => agregado.id === id)){
        pedido.platillos = platillos.filter( agregado => agregado.id !== id);
        divPlatillo.classList.remove('seleccionado');
    }else{
        pedido.platillos = [...platillos, platillo];
        divPlatillo.classList.add('seleccionado');
    } 
}

 function nombreCliente(){
    pedido.nombre = document.querySelector('#nombre').value;
}

function idCliente(){
    pedido.id = document.querySelector('#id').value;
}

function seleccionarMesa(){
    const inputMesa = document.querySelector('#mesa');
    inputMesa.addEventListener('input', function(){
        pedido.mesa = inputMesa.value;
    })
}

function seleccionarFecha(){
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(){
        pedido.fecha = inputFecha.value;
    })
}

function seleccionarHora(){
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e){
        
        const horaPedido = e.target.value;
        const hora = horaPedido.split(':')[0];
        if(hora < 15 || hora >= 23){
            e.target.value - '';
            mostrarAlerta('La hora seleccionada no es valida, verifique.', 'error', '.formulario');
        }else{
            pedido.hora = e.target.value;
        }
    })
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia) {
        alertaPrevia.remove();
    }

    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if(desaparece){
        setTimeout(() =>{
            alerta.remove();
        }, 3000);
    }  
}

function mostrarResumen() {
    const summary = document.querySelector('.contenido-summary');

    while(summary.firstChild){
        summary.removeChild(summary.firstChild);
    }

    if(Object.values(pedido).includes('') || pedido.platillos.length === 0){
        mostrarAlerta('Pedido incompleto, verifique que todos los campos estén llenos.', 'error', 
        '.contenido-summary', false);
        return;
    }

    const {mesa, fecha, hora, platillos} = pedido;

    const headingPedido = document.createElement('H3');
    headingPedido.textContent = 'Resumen órdenes enviadas';
    summary.appendChild(headingPedido);

    platillos.forEach(platillos => {     
        const {id, nombre, precio} = platillos;
            
        const contenedorPlatillo = document.createElement('DIV');
        contenedorPlatillo.classList.add('contenedor-platillo');
        
        const textoPlatillo = document.createElement('P');
        textoPlatillo.textContent = nombre; 

        const aumentarPlatillos = document.createElement('BUTTON');
        aumentarPlatillos.classList.add('button-add');
        aumentarPlatillos.innerHTML = 'Aumentar numero de platillo';
        aumentarPlatillos.addEventListener('click', addPlatillos);  
    
        const quitarPlatillos = document.createElement('BUTTON');
        quitarPlatillos.classList.add('button-rest');
        quitarPlatillos.innerHTML = 'disminuir numero de platillo';
        quitarPlatillos.addEventListener('click', restPlatillos);  
        
        const cantidadPLatillo = document.createElement('P');
        cantidadPLatillo.classList.add('cantidad-platillo');
        cantidadPLatillo.innerHTML = `<span>Numero de platillo a servir: </span> ${contador}`;
        
        const precioPlatillo = document.createElement('P');
        precioPlatillo.classList.add('precio-platillo');
        precioPlatillo.innerHTML = `<span>Precio: </span> $${precio}`;


        contenedorPlatillo.appendChild(textoPlatillo);
        contenedorPlatillo.appendChild(aumentarPlatillos);
        contenedorPlatillo.appendChild(quitarPlatillos);
        contenedorPlatillo.appendChild(cantidadPLatillo);
        contenedorPlatillo.appendChild(precioPlatillo);
        
        summary.appendChild(contenedorPlatillo);
    });

    const headingDetalles = document.createElement('H3');
    headingDetalles.textContent = 'Mostrando detalles de su orden';
    summary.appendChild(headingDetalles);

    const mesaPedido = document.createElement('P');
    mesaPedido.innerHTML = `<span>Mesa:</span> ${mesa}`;

    const fechaPedido = document.createElement('P');
    fechaPedido.innerHTML = `<span>Fecha:</span> ${fecha}`;

    const horaPedido = document.createElement('P');
    horaPedido.innerHTML = `<span>hora:</span> ${hora}`;

    //Boton para enviar pedido
    const botonFinalPedido = document.createElement('BUTTON');
    botonFinalPedido.classList.add('button');
    botonFinalPedido.textContent = 'Enviar pedido';
    botonFinalPedido.onclick = enviarPedido;
    
    const precioTotalOrden = document.createElement('P');
    precioTotalOrden.classList.add('contenido-summary');
    precioTotalOrden.innerHTML = `<span>Total de su orden: </span> ${precioFinal}`;
    
    //Detalles finales del pedido
    summary.appendChild(mesaPedido);
    summary.appendChild(fechaPedido);
    summary.appendChild(horaPedido);
    summary.appendChild(precioTotalOrden);
    summary.appendChild(botonFinalPedido);
    
}

function addPlatillos(){
    contador ++;
    console.log('Click en agregar platos')
    console.log(contador)
    precioPlatillo = (contador * precio);
    console.log(precioPlatillo);
}

function restPlatillos(){
    if(contador === 1){
        Swal.fire('mínimo de platillo es: 1');
    }else{
        contador --;
        console.log('Click en disminuir platos')
        console.log(contador)
    }
    
}


async function enviarPedido(){

    const { nombre, id, mesa, fecha, hora, platillos } = pedido;
    const idPlatillos = platillos.map( platillo => platillo.id);
    
    const datos = new FormData(); 
    datos.append('usuarioid', id); 
    datos.append('mesaid', mesa);
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('platillos', idPlatillos);

    try {
        const url = 'http://localhost:3000/api/pedidos'
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos 
        });

        const resultado = await respuesta.json();
        console.log(resultado.resultado);

        if(resultado.resultado){
            Swal.fire({
                icon: 'success',
                title: 'Pedido enviado',
                text: 'Tu pedido fue enviado con éxito',
                button: 'OK'
            }).then( () =>{
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
                
            })
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'something went wrong',
        })        
    }

}


