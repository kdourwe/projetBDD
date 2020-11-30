<?php
class GetToContest extends Dbase{
  private $id_enfant;
  private $id_comment;

  function requete(){
    $requete="SELECT * FROM avertissement WHERE id_enfant=?";
    $reponse=$this->pdo->prepare($requete);
    $reponse->execute(array($this->id_enfant));

    $enregistrements=$reponse->fetchAll();
    return $enregistrements;
  }

  function requeteMessage(){
      $requete="SELECT * FROM comment_forum WHERE id=?";
      $reponse=$this->pdo->prepare($requete);
      $reponse->execute(array($this->id_comment));

      $enregistrements=$reponse->fetchAll();
      return $enregistrements[0];
  }

  function get($id_enfant){
    $this->id_enfant=$id_enfant;
    return $this->requete();
  }

  function launch($id_comment){
      $this->id_comment=$id_comment;
      return $this->requeteMessage();
  }
}
?>
