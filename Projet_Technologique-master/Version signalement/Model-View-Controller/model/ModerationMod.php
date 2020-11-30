<?php
class ModerationMod extends Dbase{
    private $pseudo;

    public function requete(){
        $requete="SELECT * FROM enfant WHERE pseudo=?";
        $reponse=$this->pdo->prepare($requete);
        $reponse->execute(array($this->pseudo));
        $enregistrements=$reponse->fetchAll();
        if($enregistrements[0]['admin']==0){
            $admin=1;
        }
        else{
            $admin=0;
        }

        $requete2="UPDATE enfant SET admin=? WHERE pseudo=?";
        $reponse2=$this->pdo->prepare($requete2);
        $reponse2->execute(array($admin,$this->pseudo));
    }

    public function launch($pseudo){
        $this->pseudo=$pseudo;
        return $this->requete();
    }
}