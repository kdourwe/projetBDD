<?php 
/**
* Permmet de récupérer tous les commentaires non modérés et non signalés d'un sujet de forum donnée dans la base de données
*/
class GetComment extends Dbase{
	private $id;
	
	/**
	* Récupère les commentaires pour un sujet de foruml donné dans la table 'comment_forum' de la base de données
	*/
	public function requete(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		$requete="SELECT * FROM comment_forum WHERE id_forum=? AND moderation=0 AND signale=0";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->id));

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();
		
		return $enregistrements;

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
