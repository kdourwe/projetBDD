<?php
class NewKidConnection extends Dbase{
  private $ChildId;
  private $now;
  private $right;


  public function launch($KidId,$right){
    $this->ChildId=$KidId;
    $this->right=$right;
    $this->now=strtotime("now");
    $this->requete();
  }

  public function requete(){

    $requete="INSERT INTO Connexion_enfant (id_enfant, connexion, Autorisation) VALUES (?, ?, ?)";
    $reponse=$this->pdo->prepare($requete);
    $reponse->execute(array($this->ChildId,$this->now,$this->right));
  }

}
?>
