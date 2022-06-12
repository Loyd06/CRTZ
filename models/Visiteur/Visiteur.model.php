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
}