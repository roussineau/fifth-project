

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $titulos[$id] ?></h1>
    <picture>
        <source srcset="<?php echo "build/img/blog" . $id . ".webp"?>" type="image/webp">
        <source srcset="<?php echo "build/img/blog" . $id . ".jpeg"?>" type="image/jpeg">
        <img src="<?php echo "build/img/blog" . $id . ".jpg"?>" alt="Imagen propiedad" loading="lazy">
    </picture>
    <p class="informacion-meta">Escrito el <span><?php echo $fechas[$id] ?></span> por <span>Admin</span>.</p>
    <div class="resumen-propiedad">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem sed distinctio voluptatem atque iure quibusdam repudiandae dicta, repellendus adipisci tempore nulla fuga iusto nobis doloribus iste molestias, quam deleniti reiciendis! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur odit, perspiciatis illo, corrupti alias non expedita atque ex autem itaque cupiditate repellat voluptatibus! Itaque quisquam rerum quis ea nesciunt eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem facilis explicabo, cumque in repudiandae omnis praesentium enim necessitatibus. Adipisci animi dolorum, suscipit natus excepturi cum voluptates vero quis voluptatum ipsum?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore ad minus iusto cupiditate commodi consequatur, repudiandae possimus odit nobis itaque incidunt facere corporis, numquam molestias voluptate, nulla enim. Quas, id? Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, quo ad, ratione eveniet aspernatur doloribus dolore accusantium officiis amet quia corporis dolores itaque labore, ipsam rem? Vero expedita doloremque rerum.</p>
    </div>
</main>