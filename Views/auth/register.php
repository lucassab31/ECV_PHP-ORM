<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="?page=user-store" method="POST">
            <div class="mb-3">
                <label for="user" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
                <?php if (isset($sError)) { ?> 
                    <span class="invalid-feedback"><?= $sError ?></span>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
</div>