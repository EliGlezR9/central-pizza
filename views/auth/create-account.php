<h1 class="nombre-pagina">Bienvenido</h1>
<p class="descripcion-pagina">Llena el siguiente formulario con tus datos.</p>

<?php 
    include_once __DIR__. "/../templates/alertas.php";
?>
<form class="formulario" method="POST" action="/create-account">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text"
               id="nombre"
               name="nombre"
               placeholder="Ingresa tu nombre(s)"
               value="<?php echo s($usuario->nombre); ?>"
        />
    </div>
    <div class="campo">
        <label for="apellido">Apellidos</label>
        <input type="text"
               id="apellido"
               name="apellido"
               placeholder="Ingresa tus apellidos"
               value="<?php echo s($usuario->apellido); ?>"
        />
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input type="email"
               id="email"
               name="email"
               placeholder="Ingresa tu email"
               value="<?php echo s($usuario->email); ?>"
        />
    </div>
    <div class="campo">
        <label for="telefono">telefono</label>
        <input type="tel"
               id="telefono"
               name="telefono"
               placeholder="Ingresa tu número de celular"
               value="<?php echo s($usuario->telefono); ?>"
        />
    </div>
    <div class="campo">
        <label for="password">password</label>
        <input type="text"
               id="password"
               name="password"
               placeholder="Ingresa tu password"
        />
    </div>

    <input type="submit" value="Crear cuenta" class="button">
</form>

<div class="acciones">
    <a href='/'>Ya tienes una cuenta? Inicia sesión</a>
    <a href='/forgot'>Olvidaste tu password..?</a>
</div>