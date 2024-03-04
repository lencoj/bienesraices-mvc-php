<main class="contenedor seccion contenido-centrado">
    <?php foreach($blogs as $blog):?>

    <article class="entrada-blog">
        <div class="imagen">
            <a href="entrada?id=<?php echo $blog->id; ?>">
                <picture>
                    <img loading="lazy" src="/imagenes/<?php echo $blog->imagen; ?>" alt="Texto Entrada Blog">
                </picture>
            </a>
        </div>

        <div class="texto-entrada">
            <a href="entrada?id=<?php echo $blog->id; ?>">
                <h4><?php echo $blog->titulo; ?></h4>
                <p class="informacion-meta">Escrito el: <span><?php echo $blog->fecha;?></span> por: <span><?php echo $blog->autor; ?></span></p>
                <p><?php echo $blog->detalles; ?></p>
            </a>
        </div>
    </article>

    <?php endforeach; ?>
</main>