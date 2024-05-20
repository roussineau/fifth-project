<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>
    <img src="imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen propiedad" loading="lazy">
    <div class="resumen-propiedad margin-bottom-3dot5rem">
        <p class="precio">$<?php echo $propiedad->precio; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="Icono baño">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Icono garaje">
                <p><?php echo $propiedad->estacionamientos; ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="Icono dormitorio">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad->descripcion; ?></p>
    </div>
</main>