<?php 
/**
* Récupère le profil d'un parent en fonction de son id dans la base de données
*/
class GetProfil extends Dbase{
	private $id;
	/**
	* Récupère le profil dans la table 'parent' de la base de données
	* Renvoie null si le profil n'existe pas
	*/
	public function requete(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		$requete="SELECT * FROM parent WHERE id=?";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->id));

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
			return $enregistrements[0];
		}
		else{
			return null;
		}
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
