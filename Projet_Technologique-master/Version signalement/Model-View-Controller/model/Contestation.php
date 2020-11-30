<?php
class Contestation extends Dbase{
  private $id;

  public function requete(){
    	$requete="SELECT * FROM comment_forum WHERE signale=1 AND moderation=1 AND Contestation=-1 AND id_createur=?";
      $reponse=$this->pdo->prepare($requete);
      $reponse->execute(array($this->id));

      $enregistrement=$reponse->fetchAll();
      
  }
}
?>
