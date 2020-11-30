<?php 
class MyKids extends Dbase{
	private $id;
	
	public function requete(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		$requete="SELECT * FROM enfant WHERE parent=?";

		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->id));

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();

		//connaitre le nombre d'enregistrements
		$nombrereponses=count($enregistrements);

		//tester si un enregistrement existe (on suppose qu'un même pseudo n'existe qu'une fois)
		if ($nombrereponses > 0)
		{
			return $enregistrements;
		}
		else
		{
			return null;
		}
	}
	
	public function get($id){
		$this->id=$id;
		return $this->requete();
	}
}


?>