<?php
/**
* Récupère toutes les tentatives de connexion d'un enfant dans la base de données
*/
class GetKidConnexion extends Dbase{
  private $id;
  /**
  * Récupère toutes les tentatives de connexion d'un enfant dans la table 'Connexion_enfant' de la base de données
  */
  function requete(){
    $requete="SELECT * FROM Connexion_enfant WHERE id_enfant=?";
    $reponse=$this->pdo->prepare($requete);
    $reponse->execute(array($this->id));

    $enregistrements=$reponse->fetchAll();
    if (count($enregistrements)>0){
      return $enregistrements;
    }
    return 0;
  }
  
  /**
  * Enregistre le paramètre donné en attribut
  * Lance la requête et renvoie son résultat
  */
  function get($id_enfant){
    $this->id=$id_enfant;
    return $this->requete();
  }
}
?>
