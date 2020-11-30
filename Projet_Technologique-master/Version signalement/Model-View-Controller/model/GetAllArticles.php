<?php 
/**
* Permet de récupérer tous les article dans la table 'article'de la base de données
*/
class GetAllArticles extends Dbase{
	/**
	* Récupère les articles dans la table 'article' de la base de données
	*/
	public function requete(){
		// On récupère tous les sujets qui ne sont pas modérés
		$requete="SELECT * FROM article";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute();
		
		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();

		return $enregistrements;
		
	}
	
	/**
	* Renvoie le résultat de la requête
	*/
	public function get(){
		return $this->requete();
	}
}


?>
