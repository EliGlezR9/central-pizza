<h1 class="nombre-pagina">Menu principal</h1>
<p class="descripcion-pagina">Seleccione su pedido</p>


<div class="barra">
    <p class="name-text">Bienvenido: <?php echo $nombre ?? '';?>!</p>   
    <a class="button" href="/admin-panel">Oder history</a>
    <a class="button" href="/logout">Log out</a>
</div>

<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Platillos</button>
        <button type="button" data-paso="2">Detalles de orden</button>
        <button type="button" data-paso="3">Order Summary</button>
    </nav>
    <div id="paso-1" class="seccion">
        <h2>Platillos</h2>
        <p class="text-center">Elige los platillos a continuación</p>
        <div id="servicios" class="listado-platillos"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Información de su orden</h2>
        <p class="text-center">Elige la mesa, fecha y hora donde serviremos tu pedido</p>
        <form class="formulario">
        <div class="campo">
                <label for="nombre">Nombre</label>
                <input 
                    id="nombre"    
                    type="text"
                    placeholder="nombre de usuario"
                    value="<?php echo $nombre; ?>"
                    disabled
                />
            </div>

            <div class="campo">
                <label for="mesa">Mesa</label>
                <input 
                    id="mesa"    
                    type="number"
                    min="1"
                    max="10"
                />
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input 
                    id="fecha"    
                    type="date"
                    min="<?php echo date('Y-m-d');?>"
                    value="<?php echo $fecha; ?>"
                />
            </div>

            <div class="campo">
                <label for="hora">Hora</label>
                <input 
                    id="hora"    
                    type="time"
                    min="<?php echo time() ?>"
                />
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>

        
    </div>
    <div id="paso-3" class="seccion contenido-summary">
        <h2>Pedido Summary</h2>
        <p class="text-center">Verifica que la orden esté correcta, por favor</p>
        
    </div>  

    <div class="paginacion">
        <button
            id="anterior"
            class="button"
        >&laquo; Anterior </button>

        <button
            id="siguiente"
            class="button"
        >Siguiente &raquo;</button>
    </div>
</div>

<?php
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
        

    ";
?>