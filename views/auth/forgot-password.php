<h1 class="nombre-pagina">Restablecer nueva password</h1>
<p class="descripcion-pagina">Ingresa tu Email para restablecer password</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>


<form class="formulario" method="POST" action="/forgot">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email"
               id="email"
               name="email"
               placeholder="Ingresa tu email"        
        />
    </div>

    <input type="submit" value="Restablecer password" class="button" >
</form>

<div class="acciones">
    <a href='/'>Ya tienes una cuenta? Inicia sesión</a>
    <a href='/create-account'>Aún no tienes una cuenta..? Crea una cuenta ahora.</a>
</div>