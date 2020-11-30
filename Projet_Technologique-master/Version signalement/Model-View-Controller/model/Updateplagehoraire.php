<?php
class Updateplagehoraire extends Dbase{
    private $enfant;
    private $heure_dbt;
    private $heure_fin;

    public function launch(){
        $this->enfant=$_POST['idEnf'];
        $chaine=trim($_POST['pseudo']);
        $sep=stripos($chaine,'-');
        if ($sep===false ||strlen($chaine)==0)
            return;
        $this->heure_dbt=substr($chaine,0,$sep);
        $this->heure_fin=substr($chaine,(strlen($chaine)-$sep-1)*-1);
        $this->requete();
    }

    public function requete(){
        $requete="UPDATE plage_horaire SET heure_dbt=?, heure_fin=? WHERE id=?";
        $reponse=$this->pdo->prepare($requete);
        $reponse->execute(array($this->heure_dbt, $this->heure_fin,$this->enfant));
    }

}
?>