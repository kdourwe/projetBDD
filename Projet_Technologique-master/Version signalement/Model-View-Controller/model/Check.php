<?php
/**
* Permet la connexion à un compte
*/
class Check extends Dbase{
	public $identite;
	private $mdp;
	private $pseudo;
	private $status;

	/**
	* Récupère dans la table jeune ou parent de la base de donnée le profil correspondant au pseudonyme rentré
	* Renvoie null si aucun profil ne correspond.
	* Sinon la fonction vérifie que les mots de passe correspondent
	* Renvoie le profil si c'est le cas, null sinon
	*/
	public function requete(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		if ($this->status=="Jeune"){
			$requete="SELECT * FROM enfant WHERE pseudo=?";
		}
		else{
			$requete="SELECT * FROM parent WHERE pseudo=?";
		}
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->pseudo));

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();

		//connaitre le nombre d'enregistrements
		$nombrereponses=count($enregistrements);

		//tester si un enregistrement existe (on suppose qu'un même pseudo n'existe qu'une fois)
		if ($nombrereponses > 0)
		{
			//on applique la fonction md5 au mot de passe du formulaire
			if ($enregistrements[0]['pswd']==md5($this->mdp))
			{
				return $enregistrements[0];
			}
			else{
				return null;
			}
		}
		else
		{
			return null;
		}
	}

	/**
	* Enregistre les paramètres d'entrée dans les attributs
	* Lance la requête
	*/
	public function verifier($mdp, $pseudo,$status){
		$this->mdp=$mdp;
		$this->pseudo=$pseudo;
		$this->status=$status;
		return $this->requete();
	}
}


?>
