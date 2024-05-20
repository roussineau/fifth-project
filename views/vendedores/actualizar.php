<main class="contenedor seccion">
    <a href="/admin" class="boton boton-naranja">Volver</a>

    <h1>Actualizar vendedor</h1>

    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php } ?>
    <form method="POST" class="formulario">
        <?php include 'formulario.php' ?>
        <input type="submit" value="Guardar cambios" class="boton boton-verde">
    </form>

</main>