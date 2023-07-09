<h1 class="nombre-pagina">Historial de órdenes</h1>



<div class="barra">
    <p class="name-text">Bienvenido: <?php echo $nombre ?? '';?>!</p>
    
    <a class="button" href="/logout">Cerrar sesión</a>
</div>

<h2>Busqueda pedidos realizados</h2>
<div class="busqueda">
    <form class="formulario" action="">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" 
                   name="fecha" 
                   id="fecha"
            />
        </div>

    </form>
</div>

<div id="pedidos-admin">
    <ul class="pedidos">
        <?php
            foreach($pedidos as $pedido){
        ?>
        <li>
            <p>ID: <span><?php echo $cita->id;?></span></p>

        </li>
        <?php }?>
    </ul>
</div>

