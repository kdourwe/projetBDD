<?php 
/**
* Récupère le nom de l'établissement auquel appartient un code donné
*/
class GetEtalissement extends Dbase{
	private $id;
	/**
	* Récupère l'id de l'établissement en fonction de l'id du code dans la table 'code' de la base de données
	* Récupère et renvoie le nom de l'étalissement en question
	*/
	public function requete(){
		// Récupérer l'id de l'établissement
		$requete="SELECT * FROM code WHERE id=?";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->id));
		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();
		
		// Récupérer le nom de l'établissement
		$requete2="SELECT * FROM etablissement WHERE id=?";
		$reponse2=$this->pdo->prepare($requete2);
		$reponse2->execute(array($enregistrements[0]['etablissement']));
		$enregistrements2=$reponse2->fetchAll();
		
		return $enregistrements2[0]['nom'];		
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
