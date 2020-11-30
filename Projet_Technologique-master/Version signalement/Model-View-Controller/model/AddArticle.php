<?php 
/**
* Permet d'ajouter un article à la base de données
*/
class AddArticle extends Dbase{
	private $contenu;
	private $titre;
	
	/**
	Enregistre le titre et le contenu de l'article dans les attributs.
	Lance la requête.
	*/
	public function launch($titre,$contenu){
		$this->titre=$titre;
		$this->contenu=$contenu;
		$this->requete();
	}
	
	/**
	Ajoute l'article à la table article de la base de donnée	
	*/
	public function requete(){
		
		// Ajout du commentaire
		$requete="INSERT INTO article (nom, contenu, creation) 
		VALUES (?, ?, NOW())";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->titre,$this->contenu));
	}

}


?>
