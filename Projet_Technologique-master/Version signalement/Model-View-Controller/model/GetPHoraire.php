<?php
/**
* Récupère la plage horaire de connexion autorisée d'un enfant dans la base de données
*/
class GetPHoraire extends Dbase{
    private $id;
    /**
    * Récupère la plage horaire dans la table 'plage_horaire' de la base de données
    */
    public function requete(){
        $requete="SELECT * FROM plage_horaire WHERE id_enfant=?";
        $reponse=$this->pdo->prepare($requete);
        $reponse->execute(array($this->id));

        $enregistrements=$reponse->fetchAll();
        if(count($enregistrements)>0)
            return $enregistrements[0];
        else
            return null;
    }

    /**
    * Enregistre le paramètre donné en attribut
    * Lance la requête et renvoie son résultat
    */
    public function get($id){
        $this->id=$id;
        return $this->requete();
    }
}
?>
