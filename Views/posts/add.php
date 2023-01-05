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
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>