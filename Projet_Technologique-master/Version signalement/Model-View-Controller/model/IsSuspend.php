<?php 
/**
* Vérifie dans la base de données si un enfant est suspendu
*/
class IsSuspend extends Dbase{
	private $pseudo;
	/**
	* Récupère le profil de l'enfant dans la table 'enfant' de la base de données
	* Renvoie true s'il est suspendu, false sinon et null si le pseudo donné n'existe pas
	*/
	public function requete(){
		$requete="SELECT * FROM enfant WHERE pseudo=?";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->pseudo));

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();

		//connaitre le nombre d'enregistrements
		$nombrereponses=count($enregistrements);

		//tester si un enregistrement existe (on suppose qu'un même pseudo n'existe qu'une fois)
		if ($nombrereponses>0)
		{
			if ($enregistrements[0]['suspension']==1){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return null;
		}
	}
	
	/**
	* Enregistre le pseudo enregistré dans $_SESSION en attribut
	* Lance la requête et renvoie son résultat
	*/
	public function get(){
		$this->pseudo=$_SESSION['pseudo'];
		return $this->requete();
	}
	
}


?>
