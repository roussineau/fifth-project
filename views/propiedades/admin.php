<main class="contenedor seccion">
    <?php
        if ($resultado) {
            $mensaje = mostrarNotificacion(intval($resultado));
            if ($mensaje) { ?>
                <p class="alerta exito"><?php echo s($mensaje); ?></p>
            <?php }
        }
    ?>

    <h1 class="no-margin-bottom">Administrador de Bienes Raíces</h1>
    <div class="space-between">
        <div class="space-between">
            <a href="/admin/propiedades/crear" class="boton boton-verde">Nueva propiedad</a>
            <a href="/admin/vendedores/crear" class="boton boton-naranja">Nuevo vendedor</a>
        </div>
        <a href="/logout" class="boton boton-rojo">Cerrar sesión</a>
    </div>


    <h2 class="no-margin-bottom">Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody> <!-- Mostrar los resultados -->
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td class="first-column"><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td>
                        <a href="admin/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-naranja-block change-padding-topbottom">Actualizar</a>
                        <form method="POST" action="/admin/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="no-margin-bottom">Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre completo</th>
                <th>Teléfono</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody> <!-- Mostrar los resultados -->
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td class="first-column"><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <a href="/admin/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-naranja-block change-padding-topbottom">Actualizar</a>
                        <form method="POST" action="/admin/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</main>