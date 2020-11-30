<?php
class UpdateMdpParent extends Dbase{
    private $id;
    private $nvMdpP;

    public function launch(){
        $this->nvMdpP=$_POST['pseudo'];
        $this->enfant=$_POST['idEnf'];
        $this->requete();
    }

    public function requete(){
        $requete="UPDATE parent SET pswd=? WHERE id=?";
        $reponse=$this->pdo->prepare($requete);
        $reponse->execute(array(md5($this->nvMdpP),$this->id));
    }
}
?>