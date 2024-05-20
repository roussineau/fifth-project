<main class="contenedor seccion contenido-centrado">

    <h1>Iniciar sesión</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/login">

        <fieldset>
            <legend>Correo electrónico y contraseña</legend>

            <label for="email">Correo electrónico</label>
            <input type="email" placeholder="Tu correo" id="email" name="email" required>

            <label for="password">Contraseña</label>
            <input type="password" placeholder="Tu contraseña" id="password" name="password" required>
        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" class="boton boton-naranja" value="Iniciar sesión">
        </div>

    </form>
</main>