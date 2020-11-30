<?php
class UpdateComments extends Dbase{
    private $id;
    private $choice;

    public function launch($id,$dec){
        $this->id=$id;
        $this->choice=$dec;
        $this->requete();
    }

    public function requete(){
        if($this->choice==0){
            $requete="UPDATE avertissement SET Contester=0 WHERE id_commentaire=?";
            $reponse=$this->pdo->prepare($requete);
            $reponse->execute(array($this->id));
        }
        else{
            $requete="UPDATE comment_forum SET signale=0 WHERE id=?";
            $reponse=$this->pdo->prepare($requete);
            $reponse->execute(array($this->id));

            $requete2="DELETE FROM avertissement WHERE id_commentaire=?";
            $reponse2=$this->pdo->prepare($requete2);
            $reponse2->execute(array($this->id));
        }

    }

}
?>