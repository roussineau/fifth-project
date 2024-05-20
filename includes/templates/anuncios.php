<?php

use App\Propiedad;


// Solo en caso de estar en la pagina principal listaremos todas las propiedades:
if ($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
    $propiedades = Propiedad::all();
} else {
    $propiedades = Propiedad::get(3);
}


?>


<div class="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad) : ?>
        <div class="anuncio">
            <picture>
                <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Anuncio" loading="lazy">
            </picture>
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo $propiedad->descripcion; ?></p>
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
                <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-naranja-block">Ver propiedad</a>
            </div>
        </div> <!-- .anuncio-->
    <?php endforeach; ?>
</div> <!-- .contenedor-anuncios -->