<?php 
/**
* Permet de créer ou lever une suspension d'un enfant
*/
class AlterSuspension extends Dbase{
	private $id;
	/**
	* Récupère la valeur du champ 'suspension' du profil de l'enfant 
	* Modifie le profil de l'enfant dans la table enfant de la base de données pour inverser la valeur du champs 'suspension'
	*/
	public function requete(){
		// on récupère le statut du jeune 
		$requete="SELECT * FROM enfant WHERE id=?";

		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->id));

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();
		
		if($enregistrements[0]['suspension']==0){
			$suspend=1;
		}
		else{
			$suspend=0;
		}
		
		//On modifie le statut de suspension
		$requete2="UPDATE enfant 
		SET suspension=?
		WHERE id=?";
		$reponse2=$this->pdo->prepare($requete2);
		$reponse2->execute(array($suspend,$this->id));

	}
	
	/**
	* Enregistre l'id en attribut
	* Lance la requête
	*/
	public function change($id){
		$this->id=$id;
		return $this->requete();
	}
}


?>
