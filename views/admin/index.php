
<h1 class="nombre-pagina">Historial de órdenes</h1>



<div class="barra">
    <p class="name-text">Bienvenid@: <?php

use Model\Pedido;

 echo $nombre ?? '';?>!</p>
    
    <a class="button" href="/main-menu">Main menu</a>
    <a class="button" href="/logout">Log out</a>
</div>

<h2>Busqueda pedidos realizados</h2>
<div class="busqueda">
    <form class="formulario" action="">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" 
                   name="fecha" 
                   id="fecha"
                   value="<?php echo $fecha; ?>"
            />
        </div>
    </form>
</div>

<?php
    if(count($pedidos) === 0){
        echo '<h2>No hay ordenes para mostrar en esta fecha.</h2>';
    }
?>


<div id="pedidos-admin">
    <?php 
    //debuguear($pedidos);
    ?>
    <ul class="pedidos">
                <?php
                    $idPedido = 0;
                    foreach( $pedidos as $key => $pedido ){
                        if($idPedido !== $pedido->id){
                            $total = 0;
                ?>
                <li>
                    <h3>Información del pedido</h3>

                    <p>ID: <span><?php echo $pedido->id;?></span></p>
                    <p>Hora: <span><?php echo $pedido->hora;?></span></p>
                    <p>Cliente: <span><?php echo $pedido->cliente;?></span></p>
                    <p>Email: <span><?php echo $pedido->email;?></span></p>
                    <p>Telefono: <span><?php echo $pedido->telefono;?></span></p>                        

                    <h3>Platillos ordenados</h3>
            <?php 
                $idPedido = $pedido->id;
            } //Fin de IF 
                $total += $pedido->precio;
            ?>
                    <p class="platillo"><?php echo $pedido->platillo. " " . 
                    $pedido->precio; ?></p>
            <?php 
                $actual = $pedido->id;
                $proximo = $pedidos[ $key + 1 ]->id ??0;
                    
                if(esUltimo($actual, $proximo)){ ?>
                <p class="total">Total: <span>$ <?php echo $total; ?></span></p>
            <?php }
        } //Fin de ForEach ?>
    </ul>
</div>

<?php

    $script = "<script src='build/js/buscador.js'></script>"

?>

