<h1>Création d'un nouvel article</h1>
<form method="POST" action="validation_creerArticle">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre de l'article</label>
        <input type="text" class="form-control" id="titre" name="titre">
    </div>
    <div class="mb-3">
        <label for="corps" class="form-label">Contenu de l'article</label>
        <textarea class="form-control" id="corps" name="corps" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Créer !</button>
</form>            