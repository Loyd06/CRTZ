<?php

require_once("./controllers/MainController.controller.php");
require_once("./models/Utilisateur/Utilisateur.model.php");

class UtilisateurController extends MainController{
    private $utilisateurManager;

    public function __construct() {
       $this->utilisateurManager = new UtilisateurManager();
    
    }
    public function validation_login($login,$password){      
        if($this->utilisateurManager->isCombinaisonValide($login,$password)){
            if($this->utilisateurManager->estCompteActif($login)){
                Toolbox::ajouterMessageAlerte("Bon retour sur le site ".$login." !", Toolbox::COULEUR_VERTE);
                $_SESSION['profil'] = [
                    "login" => $login,
                ];
                header("location: ".URL."compte/profil");
            } else {
                Toolbox::ajouterMessageAlerte("Le compte ".$login. " n'a pas été activé par mail", Toolbox::COULEUR_ROUGE);
                //renvoyer le mail de validation
                header("Location: ".URL."login");
            }
        } else {
            Toolbox::ajouterMessageAlerte("Combinaison Login / Mot de passe non valide", Toolbox::COULEUR_ROUGE);
            header("Location: ".URL."login");
        }
    }

    public function creerArticle(){
        $data_page = [
            "page_description" => "Page de création de compte",
            "page_title" => "Page de création de compte",
            "view" => "views/Utilisateur/creerArticle.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }
    public function validation_creerArticle($titre,$corps){
        if($this->utilisateurManager->bdCreerArticle($titre,$corps,$_SESSION['profil']['login'])){
            Toolbox::ajouterMessageAlerte("L'article a été créé avec succès", Toolbox::COULEUR_VERTE);
            header("Location: ".URL."compte/profil");
        } else {
            Toolbox::ajouterMessageAlerte("Erreur lors de la création de l'article !", Toolbox::COULEUR_ROUGE);
            header("Location: ".URL."compte/creerArticle");
        }
    }
    public function listerArticles(){
        $articles = $this->utilisateurManager->getArticles($_SESSION['profil']['login']);
        $data_page = [
            "page_description" => "Liste des articles de blog",
            "page_title" => "Liste des articles de blog",
            "articles" => $articles,
            "view" => "views/Utilisateur/listerArticles.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function modifierArticle($id){
        if ($this->utilisateurManager->idArticleValide($id, $_SESSION['profil']['login'])) {
            $article = $this->utilisateurManager->getArticle($id);
            $data_page = [
                "page_description" => "Page de création de compte",
                "page_title" => "Page de création de compte",
                "article" => $article,
                "view" => "views/Utilisateur/modifierArticle.view.php",
                "template" => "views/common/template.php"
            ];
        $this->genererPage($data_page);
        } else {
            Toolbox::ajouterMessageAlerte("Cet article n'existe pas !", Toolbox::COULEUR_ROUGE);
            header("Location: ".URL."compte/listerArticles");
        }  
    }

    public function validation_modifierArticle($id,$titre,$corps) {
        if($this->utilisateurManager->majArticle($id,$titre,$corps)){
            Toolbox::ajouterMessageAlerte("L'article a été mis à jour avec succès", Toolbox::COULEUR_VERTE);
            header("Location: ".URL."compte/listerArticles");
        } else {
            Toolbox::ajouterMessageAlerte("Vous n'avez effectué aucun changement", Toolbox::COULEUR_ROUGE);
            header("Location: ".URL."compte/listerArticles");
        }
    }


    public function profil(){
        $datas = $this->utilisateurManager->getUserInformation($_SESSION['profil']['login']);
        $_SESSION['profil']["role"] = $datas['role'];
       
        $data_page = [
            "page_description" => "Page de profil",
            "page_title" => "Page de profil",
            "utilisateur" => $datas,
            "view" => "views/Utilisateur/profil.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);

            
    }

    public function deconnexion(){
        Toolbox::ajouterMessageAlerte("La deconnexion est effectuée",Toolbox::COULEUR_VERTE);
        unset($_SESSION['profil']);
        header("Location: ".URL."accueil");
    }

    public function validation_creerCompte($login,$password,$mail){
        if($this->utilisateurManager->verifLoginDisponible($login)){
            $passwordCrypte = password_hash($password,PASSWORD_DEFAULT);
            
            if($this->utilisateurManager->bdCreerCompte($login,$passwordCrypte,$mail)){
                Toolbox::ajouterMessageAlerte("La compte a été créé, Un mail de validation vous a été envoyé !", Toolbox::COULEUR_VERTE);
                header("Location: ".URL."login");
            } else {
                Toolbox::ajouterMessageAlerte("Erreur lors de la création du compte, recommencez !", Toolbox::COULEUR_ROUGE);
                header("Location: ".URL."creerCompte");
            }
        } else {
            Toolbox::ajouterMessageAlerte("Le login est déjà utilisé !", Toolbox::COULEUR_ROUGE);
            header("Location: ".URL."creerCompte");
        }
    }

    public function pageErreur($msg){
        parent::pageErreur($msg);
    }

}