<?php

require_once ("./models/MainManager.model.php");

class VisiteurManager extends MainManager {
    public function getUtilisateurs(){
        $req=$this->getBdd()->prepare("select * from utilisateur");
        $req->execute();
        $datas=$req->fetchAll();
        $req->closeCursor();
        return$datas;
    }

    public function getLastArticles($off, $lim) {
        $req = "SELECT * FROM article ORDER BY created_at DESC LIMIT :off, :lim";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":off",$off,PDO::PARAM_INT);
        $stmt->bindValue(":lim",$lim,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }
}

