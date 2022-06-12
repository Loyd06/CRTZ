<h1>Liste des Articles CORTEIZ <a href="<?= URL; ?>compte/creerArticle" class="btn btn-success ms-3">Nouvel Article</a></h1>
<?php foreach ($articles as $article) {
    echo '<hr>';
    echo "<h4>".$article["titre"]."</h4>";
    echo "Créé le " . $article["created_at"]. "</br>";
    echo "date dernière modification" . $article["updated_at"];
    echo '<a href="'.URL.'compte/modifierArticle/'.$article['id'].'" class="btn btn-primary ms-3">Modifier</a>';
} ?>
