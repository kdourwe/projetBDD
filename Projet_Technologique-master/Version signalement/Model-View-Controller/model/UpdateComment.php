<?php 
class UpdateComment extends Dbase{
	private $id;
	
	public function launch($id){
		$this->id=$id;
		$this->requete();
		return $this->getIdSujet();
	}
	
	public function requete(){
		
		// mise à jour du commentaire (valeurs de signale et nltk_val)
		$requete2="UPDATE comment_forum 
		SET signale=1, nltk_val=0.8
		WHERE id=?";
		$reponse2=$this->pdo->prepare($requete2);
		$reponse2->execute(array($this->id));
	}
	
	public function getIdSujet(){
		$requete="SELECT * FROM comment_forum WHERE id=?";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->id));

		$enregistrements=$reponse->fetchAll();

		//connaitre le nombre d'enregistrements
		$nombrereponses=count($enregistrements);

		//tester si un enregistrement existe
		if ($nombrereponses ==0)
		{
			return null;
		}
		else if ($nombrereponses ==1)
		{
			return $enregistrements[0]['id_forum'];
		}
		else{
			return null;
		}
	}
}


?>
