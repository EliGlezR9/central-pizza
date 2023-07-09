<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Iniciar sesión con tus datos.</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email"
               id="email"
               placeholder="Ingresa tu Email."
               name="email"
        />
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password"
               id="password"
               placeholder="Ingresa tu password."
               name="password"
        />
    </div>

    <input type="submit" class="button" value="Iniciar sesión">
</form>

<div class="acciones">
    <a href='/create-account'>Aún no tienes una cuenta..? Crea una cuenta ahora.</a>
    <a href='/forgot'>Olvidaste tu password..?</a>
</div>