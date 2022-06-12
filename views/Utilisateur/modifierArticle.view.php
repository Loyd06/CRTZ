<h1>Modification d'un article</h1>
<form method="POST" action="<?= URL ?>compte/validation_modifierArticle/<?= $article['id'] ?>">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre de l'article</label>
        <input type="text" class="form-control" id="titre" name="titre" 
        value="<?= $article['titre'] ?>">
    </div>
    <div class="mb-3">
        <label for="corps" class="form-label">Contenu de l'article</label>
        <textarea class="form-control" id="corps" name="corps" rows="3"><?= $article['corps'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Valider la modification</button>
</form>