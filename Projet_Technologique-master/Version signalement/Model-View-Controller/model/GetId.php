<?php 
/**
* Récupère l'id d'une personne pour un pseudo donné dans la base de données
*/
class GetId extends Dbase{
	private $pseudo;
	private $status;
	
	/**
	* Récupère l'id correspondant à un pseudo donné dans la table 'enfant' ou la table 'parent' de la base de données
	* Renvoie null si le pseudo n'existe pas
	*/
	public function requete(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		if ($this->status=="Jeune"){
			$requete="SELECT * FROM enfant WHERE pseudo=?";
		}
		else{
			$requete="SELECT * FROM parent WHERE pseudo=?";
		}
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->pseudo));

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();

		//connaitre le nombre d'enregistrements
		$nombrereponses=count($enregistrements);

		//tester si un enregistrement existe (on suppose qu'un même pseudo n'existe qu'une fois)
		if ($nombrereponses ==0)
		{
			return null;
		}
		else if ($nombrereponses ==1)
		{
			return $enregistrements[0]['id'];
		}
		else{
			return null;
		}
	}
	
	/**
	* Enregistre le pseudo et le statut de l'utilisateur en attribut
	* Lance la requête et renvoie son résultat
	*/	
	public function get(){
		$this->pseudo=$_SESSION['pseudo'];
		$this->status=$_SESSION['status'];
		return $this->requete();
	}
	
	/**
	* Enregistre les paramètres donnés en attribut
	* Lance la requête et renvoie son résultat
	*/
	public function notMyId($pseudo, $status){
		$this->pseudo=$pseudo;
		$this->status=$status;
		return $this->requete();
	}
}


?>
