<?php
/**
* Permet de vérifier si un code donné existe dans la base de données et s'il a déjà été utilisé
*/
class CheckCode extends Dbase{
	public $code;
	/**
	* Récupère l'enregistrement du code dans la table code de la base de données s'il existe, renvoie false sinon.
	* Renvoie False si le code est déjà pris, true sinon
	*/
	public function requete(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		$requete="SELECT * FROM code WHERE mycode=?";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->code));

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();

		//connaitre le nombre d'enregistrements
		$nombrereponses=count($enregistrements);

		//tester si un enregistrement existe (on suppose qu'un même code n'existe qu'une fois)
		if ($nombrereponses > 0)
		{
			//on applique la fonction md5 au mot de passe du formulaire
			if ($enregistrements[0]['pris']==0)
			{
				return true;
			}
			else{
				//code déjà pris
				return false;
			}
		}
		else
		{
			//code inconnu
			return false;
		}

	}

	/**
	* Enregistre les paramètres d'entrée dans les attributs
	* Lance la requête
	*/
	public function verifier($code){
		$this->code=$code;
		return $this->requete();

	}
}


?>
