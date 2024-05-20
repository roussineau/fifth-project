<main class="contenedor seccion">
    <a href="/admin" class="boton boton-naranja">Volver</a>

    <h1>Registrar nuevo vendedor</h1>

    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php } ?>
    <form method="POST" action="/admin/vendedores/crear" class="formulario">
        <?php include 'formulario.php' ?>
        <input type="submit" value="Registrar vendedor" class="boton boton-verde">
    </form>

</main>