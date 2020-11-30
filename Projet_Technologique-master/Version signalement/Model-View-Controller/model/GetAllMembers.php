<?php 
/**
* Permet de récupérer la liste de tous les profils parents ou enfants
*/
class GetAllMembers extends Dbase{
	private $status;
	/**
	* Récupère les profils de tous les enfants ou tous les parents dans la table 'enfant'/'parent' de la base de données
	*/
	public function requete(){
		// on récupère la liste de tous les membres jeunes/parents
		if ($this->status=="Jeune"){
			$requete="SELECT * FROM enfant";
		}
		else{
			$requete="SELECT * FROM parent";
		}
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute();

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();
		
		return $enregistrements;

	}
	
	/**
	* Enregistre le paramètre donnée en attribut
	* Lance la requête et renvoie son résultat
	*/
	public function get($status){
		$this->status=$status;
		return $this->requete();
	}
}


?>
