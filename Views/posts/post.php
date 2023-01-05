<?php
    $oDate = new DateTime($oPost->created_at);
?>
<article class="blog-post">
    <h2 class="blog-post-title"><?= $oPost->title ?></h2>
    <p class="blog-post-meta"><?= $oDate->format('d/m/Y H:i') ?> de <a href="#"><?= $oPost->user->email ?></a></p>
    <p><?= nl2br($oPost->content) ?></p>
</article>
<h4>Commentaires</h4>
<?php
    if (count($oPost->comments) > 0) {
        foreach ($oPost->comments as $comment) {
            $oDateComment = new DateTime($comment->created_at);
            ?>
            <article class="blog-post mb-0 border-bottom mt-2">
                <p class="mb-0"><?= nl2br($comment->content) ?></p>
                <p class="blog-post-meta"><?= $oDateComment->format('d/m/Y H:i') ?> de <a href="#"><?= $comment->user->email ?></a></p>
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
<h4>Ajouter un commentaire</h4>
<form action="?page=comment-store" method="post">
    <input type="hidden" name="post_id" value="<?= $oPost->id_post ?>">
    <div class="mb-3">
        <label for="content" class="form-label">Contenu</label>
        <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>