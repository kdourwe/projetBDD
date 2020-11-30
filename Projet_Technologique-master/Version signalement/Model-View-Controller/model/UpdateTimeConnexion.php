<?php
class UpdateTimeConnexion extends Dbase{
    private $enfant;
    private $nvTimeConnexion;

    public function launch(){
        $this->enfant=$_POST['idEnf'];
        $this->nvTimeConnexion=$_POST['pseudo'];
        $this->requete();
    }

    public function requete(){
        $requete="UPDATE enfant SET timer_max=? WHERE id=?";
        $reponse=$this->pdo->prepare($requete);
        $reponse->execute(array($this->nvTimeConnexion,$this->enfant));
    }
}


?>