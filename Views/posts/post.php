<?php
    $oDate = new DateTime($oPost->created_at);
?>
<article class="blog-post">
    <h2 class="blog-post-title"><?= $oPost->title ?></h2>
    <p class="blog-post-meta"><?= $oDate->format('d/m/Y H:i') ?> de <a href="#"><?= $oPost->user ?></a></p>
    <p><?= nl2br($oPost->content) ?></p>
</article>
<h4>Commentaires</h4>
<?php
    if (count($oPost->comments) > 0) {
        foreach ($oPost->comments as $comment) {
            $oDateComment = new DateTime($comment->created_at);
            ?>
            <article class="blog-post">
                <p class="mb-0"><?= nl2br($comment->content) ?></p>
                <p class="blog-post-meta"><?= $oDateComment->format('d/m/Y H:i') ?> de <a href="#"><?= $comment->user ?></a></p>
            </article>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-dark" role="alert">
            Aucun commentaire
        </div>
        <?php
    }
?>
