<main class="contenedor seccion">
    <a href="/admin" class="boton boton-naranja">Volver</a>

    <h1>Actualizar venta</h1>

    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php } ?>
    <form method="POST" class="formulario" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
    </form>

</main>