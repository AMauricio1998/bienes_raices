<?php 
    require 'includes/funciones.php';
    
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build//img/destacada2.jpg" alt="imagen de la propiedad">
        </picture>

        <p class="informacion-meta">Escrito el: <span>23/01/2023</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
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
    </main>

    <?php 
        incluirTemplate('footer');
    ?>