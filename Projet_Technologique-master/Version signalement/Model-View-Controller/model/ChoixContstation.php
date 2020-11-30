<?php
class ChoixContestation extends Dbase{
    private $choix;
    private $kid;

    function requete(){
        $requete="UPDATE avertissement SET Contester=? WHERE id_enfant=?";
        $reponse=$this->pdo->prepare($requete);
        $reponse->execute(array($this->choix,$this->kid));
    }
    function launch($choix,$kid){
        $this->choix=$choix;
        $this->kid=$kid;
        $this->requete();
    }
}
?>