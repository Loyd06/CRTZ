<h1>$CRTZ$</h1>
<?php foreach ($articles as $article) {
    echo '<hr>';
    echo "<h4><a href='".URL."article/{$article['id']}'>{$article['titre']}</a></h4>";
    echo "Créé le {$article['created_at']}. ";
    if (!empty($article["updated_at"])) {
        echo "Mis à jour le {$article["updated_at"]}.";
    }
    echo "</br>";
    echo "<a href='#' class='btn btn-light btn-sm' disabled><strong>Publié par</strong></a> ";
    echo "<a href='".URL."articles/{$article['login']}' class='btn btn-secondary btn-sm'> {$article['login']}</a>";
} ?>