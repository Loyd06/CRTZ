<?php

require_once("./models/MainManager.model.php");

class UtilisateurManager extends MainManager{
    
    private function getPasswordUser($login){
       
        $req = "SELECT password FROM utilisateur WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['password'];
    }


    public function isCombinaisonValide($login,$password){
       
        $passwordBD = $this->getPasswordUser($login);
        return password_verify($password,$passwordBD);
    }

    public function estCompteActif($login){
        
        $req = "SELECT est_valide FROM utilisateur WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return ((int)$resultat['est_valide'] === 1);
    }

    public function getUserInformation($login){
        $req = "SELECT * FROM utilisateur WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function verifLoginDisponible($login){
        $utilisateur = $this->getUserInformation($login);
        return empty($utilisateur);
 
    }

    public function bdCreerCompte($login,$passwordCrypte,$mail){
        $req = "INSERT INTO utilisateur (login, password, mail, est_valide, role)
        VALUES (:login, :password, :mail, 1, 'utilisateur')";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":password",$passwordCrypte,PDO::PARAM_STR);
        $stmt->bindValue(":mail",$mail,PDO::PARAM_STR);
        
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdCreerArticle($titre,$corps,$login){
        $req = "INSERT INTO article (titre, corps, created_at, login)
        VALUES (:titre, :corps, :date, :login)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":corps",$corps,PDO::PARAM_STR);
        $stmt->bindvalue(":date",date('Y-m-d'),PDO::PARAM_STR);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function getArticles($login) {
        $req = "SELECT * FROM article WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function idArticleValide($id,$login) {
        $req = "SELECT * FROM article WHERE id = :id AND login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $estValide = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estValide;
    }

    public function getArticle($id) {
        $req = "SELECT * FROM article WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function majArticle($id,$titre,$corps) {
        $req = "UPDATE article set titre = :titre, corps = :corps, updated_at = :date WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":corps",$corps,PDO::PARAM_STR);
        $stmt->bindvalue(":date",date('Y-m-d'),PDO::PARAM_STR);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

}