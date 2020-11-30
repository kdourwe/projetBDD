<?php 
/**
* Récupère tous les sujets de forum non modérés dans la base de données
*/
class GetForum extends Dbase{
	/**
	* Récupère les sujets de forum dans la table 'forum' de la base de données
	*/
	public function requete(){
		// On récupère tous les sujets qui ne sont pas modérés
		$requete="SELECT * FROM forum WHERE moderation=0";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute();
		
		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();

		return $enregistrements;
		
	}

	/**
	* Lance la requête
	*/
	public function get(){
		return $this->requete();
	}
}


?>
