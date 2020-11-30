<?php
class UpdateMail extends Dbase{
    private $id;
    private $nvMail;

    public function launch(){
        $this->nvMail=$_POST['pseudo'];
        $this->enfant=$_POST['idEnf'];
        $this->requete();
    }

    public function requete(){
        $requete="UPDATE parent SET email=? WHERE id=?";
        $reponse=$this->pdo->prepare($requete);
        $reponse->execute(array($this->nvMail,$this->id));
    }
}
?>