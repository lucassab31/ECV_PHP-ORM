<?php
    foreach ($tPosts as $post) {
        $oDate = new DateTime($post->created_at);
        ?>
        <article class="blog-post">
            <h2 class="blog-post-title"><a href="?page=post&id=<?= $post->id ?>"><?= $post->title ?></a></h2>
            <p class="blog-post-meta"><?= $oDate->format('d/m/Y H:i') ?> de <?= $post->user->email ?></p>
            <p><?= nl2br($post->content) ?></p>
        </article>
        <?php
    }
?>