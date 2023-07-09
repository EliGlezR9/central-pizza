<h1 class="nombre-pagina">Recuperar tu password</h1>
<p class="descripcion-pagina">Ingresa un nuevo password para tu cuenta en CentralPizza.com</p>

<?php
    include_once __DIR__ . "/../templates/alertas.php";
?>

<?php 
    if($error) return; 
?>

<form class="formulario" method="POST">
<div class="campo">
        <label for="password">Password</label>
        <input type="password"
               id="password"
               name="password"
               placeholder="Ingresa tu nuevo password."
        />
    </div>

    <input type="submit" class="button" value="Guardar nuevo password">

</form>

<div class="acciones">
    <a href='/'>Ya tienes una cuenta? Inicia sesión</a>
    <a href='/create-account'>Crear una cuenta ahora</a>
</div>