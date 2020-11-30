<?php 
/**
* Récupère un sujet de forum en fonction de son id dans la base de données
*/
class GetSujet extends Dbase{
	private $id;
	
	/**
	* Récupère le sujet dans la table 'forum' de la base de données
	* renvoie null si l'id n'existe pas
	*/
	public function requete(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		$requete="SELECT * FROM forum WHERE id=?";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->id));

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();
		if(count($enregistrements)>0){
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
