<?php 
/**
* Permet de récupérer le contenu d'un article
*/
class GetArticle extends Dbase{
	private $id;
	/**
	* Récupère un article dans la table 'article' de la base de données
	*/
	public function requete(){
		// On récupère tous les sujets qui ne sont pas modérés
		$requete="SELECT * FROM article WHERE id=?";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->id));
		
		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();

		return $enregistrements[0];
		
	}
	
	/**
	* Enregistre le paramètre donnée en attribut
	* Lance la requête et renvoie son résultat
	*/
	public function get($id){
		$this->id=$id;
		return $this->requete();
	}
}


?>
