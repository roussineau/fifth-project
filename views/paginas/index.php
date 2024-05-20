<main class="contenedor seccion">
    <h2>Sobre nosotros</h2>
    <?php include 'iconos.php' ?>
</main>

<section class="seccion contenedor">
    <h2>Casas y departamentos en venta</h2>
    
    <?php 
    include 'listado.php';
    ?>

    <div class="ver-todas alinear-derecha">
        <a href="/anuncios" class="boton-verde">Ver todas</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
    <a href="/contacto" class="boton-naranja">Contáctanos</a>
</section>

<div class="seccion contenedor seccion-inferior">
    <section class="blog">
        <h3>Nuestro blog</h3>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpeg" type="image/jpeg">
                    <img src="build/img/blog1.jpg" alt="Imagen blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada?id=1">
                    <h4>Aprovechar el exterior como parte del hogar</h4>
                    <p class="informacion-meta">Escrito el <span>24/02/2024</span> por <span>Admin</span>.</p>
                    <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y
                        ahorrando dinero.</p>
                </a>
            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpeg" type="image/jpeg">
                    <img src="build/img/blog2.jpg" alt="Imagen blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada?id=2">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">Escrito el <span>22/03/2024</span> por <span>Admin</span>.</p>
                    <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para
                        darle vida a tu espacio.</p>
                </a>
            </div>
        </article>
    </section>
    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>El personal se comportó de excelente manera, muy buena atención y la casa que me ofrecieron
                cumplió con todas mis expectativas.</blockquote>
            <p>—Santiago Roussineau</p>
        </div>
    </section>
</div>