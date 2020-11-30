<?php
class GetContestation extends Dbase{

    public function requete(){
        $requete="SELECT * FROM avertissement WHERE Contester=1";
        $reponse=$this->pdo->prepare($requete);
        $reponse->execute();

        $enregistrements=$reponse->fetchAll();

        return $enregistrements;
    }

    public function get(){
        return $this->requete();
    }
}
?>