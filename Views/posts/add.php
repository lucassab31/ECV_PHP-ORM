<div class="row justify-content-center">
    <div class="col-md-6">
        <form method="POST" action="?page=post-store">
          <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" name="title" id="title" required>
          </div>
          <div class="mb-3">
            <label for="content" class="form-label">Contenu</label>
            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="user" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" name="user" id="user" required>
            <div id="userHelp" class="form-text">Ce nom sera visible par tous les autres utilisateurs</div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>