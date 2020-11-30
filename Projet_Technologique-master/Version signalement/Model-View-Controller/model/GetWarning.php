<?php 
/**
* récupère l'ensemble des avertissements reçus par un enfant dans la base de donnée
*/
class GetWarning extends Dbase{
	private $id;
	/**
	* Récupère les avertissements dans la table 'avertissement' de la base de données
	*/
	public function requete(){
		// on récupère la liste de tous les avertissements de l'enfant
		$requete="SELECT * FROM avertissement WHERE id_enfant=?";
		
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->id));

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();
		
		return $enregistrements;

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
