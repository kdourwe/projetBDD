<?php 
/**
* Récupère le pseudo d'une personne en fonction de son id dans la base de données
*/
class GetPseudo extends Dbase{
	private $id;
	private $status;
	
	/**
	* Récupère le pseudo dans la table 'enfant' ou la table 'parent' de la base de données
	* Renvoie null si l'id n'existe pas
	*/
	public function requete(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		if ($this->status=="Jeune"){
			$requete="SELECT * FROM enfant WHERE id=?";
		}
		else{
			$requete="SELECT * FROM parent WHERE id=?";
		}
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->id));

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();
		
		if(count($enregistrements)>0){
			return $enregistrements[0]['pseudo'];
		}
		else{
			return null;
		}
	}
	
	/**
	* Enregistre les paramètres donnés en attribut
	* Lance la requête et renvoie son résultat
	*/
	public function get($id, $status){
		$this->id=$id;
		$this->status=$status;
		return $this->requete();
	}
}


?>
