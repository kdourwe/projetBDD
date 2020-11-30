<?php

class Comments extends Dbase {
    private $id;

    public function requete(){
        // exécuter une requête MySQL de type SELECT.. WHERE
        $requete="SELECT * FROM comment_forum WHERE id=?";
        $reponse=$this->pdo->prepare($requete);
        $reponse->execute(array($this->id));

        //récupérer tous les enregistrements dans un tableau
        $enregistrements=$reponse->fetchAll();

        return $enregistrements[0];

    }

    public function get($id){
        $this->id=$id;
        return $this->requete();
    }
}
?>