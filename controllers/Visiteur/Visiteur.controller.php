<?php
require_once("./controllers/MainController.controller.php");
require_once("./models/Visiteur/Visiteur.model.php");

class VisiteurController extends MainController{
    private $visiteurManager;

    public function __construct() {
        $this->visiteurManager = new VisiteurManager();
    }
  
    public function accueil(){
        $offset = 0;
        $limit = 15;
        $articles = $this->visiteurManager->getLastArticles($offset, $limit);
        $data_page = [
            "page_description" => "Les articles les plus récents",
            "page_title" => "Les articles les plus récents",
            "articles" => $articles,
            "view" => "views/Visiteur/accueil.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function login(){
        
        $data_page = [
            "page_description" => "Page de connexion",
            "page_title" => "Page de connexion",
            "view" => "views/Visiteur/login.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function creerCompte(){
        $data_page = [
            "page_description" => "Page de création de compte",
            "page_title" => "Page de création de compte",
            "view" => "views/Visiteur/creerCompte.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function pageErreur($msg){
        parent::pageErreur($msg);
    }
}