<?php
class ListCommentModerer extends Dbase{
    private $id;

    public function requete(){
        $requete="SELECT * FROM comment_forum WHERE id_moderateur=?";
        $reponse=$this->pdo->prepare($requete);
        $reponse->execute(array($this->id));
        $enregistrements=$reponse->fetchAll();
        if(count($enregistrements)>0){
            return $enregistrements;
        }
        return null;
    }

    public function launch($id){
        $this->id=$id;
        return $this->requete();
    }

}
?>
