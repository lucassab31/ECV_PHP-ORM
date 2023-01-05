<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="?page=user-login" method="POST">
            <div class="mb-3">
                <label for="user" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <a href="?page=register">Pas encore de compte ?</a>
            <button type="submit" class="btn btn-primary">Se Connecter</button>
        </form>
    </div>
</div>