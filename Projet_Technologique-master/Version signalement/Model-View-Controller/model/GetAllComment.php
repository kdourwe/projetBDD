<?php
class GetAllComment extends Dbase{
    private $id;

    public function requete(){
        // exécuter une requête MySQL de type SELECT.. WHERE

        $requete="SELECT * FROM avertissement WHERE id_commentaire=?";
        $reponse=$this->pdo->prepare($requete);
        $reponse->execute(array($this->id));

        //récupérer tous les enregistrements dans un tableau
        $enregistrement=$reponse->fetchAll();

        return $enregistrement;

    }

    public function get($id){
        $this->id=$id;
        return $this->requete();
    }
}


?>
