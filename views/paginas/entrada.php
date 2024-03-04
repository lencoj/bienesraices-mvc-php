<main class="contenedor seccion contenido-centrado">
    <h1>Nuestro Blog</h1>

    <article class="entrada-blog">
        <div class="imagen">
            <picture>
                <!-- <source srcset="build/img/destacada2.webp" type="imgae/webp">
                <source srcset="build/img/destacada2.jpg" type="imgae/jpeg"> -->
                <img loading="lazy" src="/imagenes/<?php echo $blog->imagen; ?>" alt="Texto Entrada Blog">
            </picture>
        </div>

        <div class="texto-entrada">
            <a href="blog?id=<?php echo $blog->id; ?>">
                <h4><?php echo $blog->titulo; ?></h4>
                <p class="informacion-meta">Escrito el: <span><?php echo $blog->fecha;?></span> por: <span><?php echo $blog->autor; ?></span></p>
                <p><?php echo $blog->detalles; ?></p>
            </a>
        </div>
    </article>
</main>