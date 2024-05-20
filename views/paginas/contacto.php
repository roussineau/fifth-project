<main class="contenedor seccion">
    <?php if ($mensaje) { ?>
       <p class="alerta <?php echo $alerta; ?>"><?php echo $mensaje; ?></p>
     <?php } ?>
    <h1>Contacto</h1>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpeg" type="image/jpeg">
        <img src="build/img/destacada3.jpg" alt="Imagen contacto" loading="lazy">
    </picture>
    <h2>Llene el formulario de contacto</h2>
    <form class="formulario" action="/contacto" method="post">
        <fieldset>
            <legend>Información personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" placeholder="Tu mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>
        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Compra o venta</label>
            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Venta</option>
            </select>

            <label for="presupuesto">Precio o presupuesto</label>
            <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto" name="contacto[precio]" required>
        </fieldset>
        <fieldset>
            <legend>Contacto</legend>

            <p>¿Cómo desea ser contactado?</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                <label for="contactar-email">Correo electrónico</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
            </div>

            <div id="contacto"></div>


        </fieldset>
        <div class="alinear-derecha">
            <input type="submit" value="Enviar" class="boton-verde">
        </div>
    </form>
</main>