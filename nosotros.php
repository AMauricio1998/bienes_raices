<?php 
    require 'includes/app.php';
    
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webg">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum dolore
                    tempora commodi ut voluptatem dolorum ratione
                    nesciunt recusandae praesentium aliquid voluptate in
                    temporibus at. Enim eum maxime nisi corporis id.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum dolore
                    tempora commodi ut voluptatem dolorum ratione
                    nesciunt recusandae praesentium aliquid voluptate in
                    temporibus at. Enim eum maxime nisi corporis id.
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum dolore
                    tempora commodi ut voluptatem dolorum ratione
                    nesciunt recusandae praesentium aliquid voluptate in
                    temporibus at. Enim eum maxime nisi corporis id.
                </p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    A nisi aut alias harum minus fugit culpa exercitationem est, 
                    non cupiditate iure quasi nobis ab id quod quae quaerat temporibus voluptate!
                </p>
            </div> <!--Icono-->
            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    A nisi aut alias harum minus fugit culpa exercitationem est, 
                    non cupiditate iure quasi nobis ab id quod quae quaerat temporibus voluptate!
                </p>
            </div> <!--Icono-->
            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    A nisi aut alias harum minus fugit culpa exercitationem est, 
                    non cupiditate iure quasi nobis ab id quod quae quaerat temporibus voluptate!
                </p>
            </div> <!--Icono-->
        </div>
    </section>

    <?php 
        incluirTemplate('footer');
    ?>