<?php 
/**
* récupère la liste des commentaires signalés et non modérés
*/
class GetSignalement extends Dbase{
	private $status;
	/**
	* Récupère et renvoie les commentaires dans la table 'comment_forum' de la base de données
	*/
	public function requete(){
		// on récupère la liste de tous les commentaires signalés
		$requete="SELECT * FROM comment_forum WHERE signale=1 AND moderation=0";
		
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute();

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();
		
		return $enregistrements;

	}

}


?>
