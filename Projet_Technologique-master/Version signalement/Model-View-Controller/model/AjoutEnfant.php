
<?php

/*
* Permet d'ajouter un profil enfant à la base de données
*/

class AjoutEnfant extends Dbase{
	private $pseudo;
	private $mdp;
	private $id;

	/**
	* Enregistre les informations nécessaires dans les attributs
	* Appelle la fonction verifier(), si cette dernière renvoie True:
	*       Lance la requête, appelle la fonction limitstime et renvoie True
	* Sinon elle renvoie false
	*/

	public function launch($id){
		$this->id=$id;
		$this->pseudo=$_POST['pseudo'];
		$this->mdp=$_POST['mdp'];
		if($this->verifier()){
			$id_enfant=$this->requete();
      $this->limitstime($id_enfant);
			return true;
		}
		else{
			return false;
		}
	}

	/**
	* Ajoute l'enfant à la table enfant de la base de données
	* Récupère dans la table l'id de l'enfant et le renvoie
	*/
	public function requete(){
		$requete="INSERT INTO enfant (pseudo, pswd, parent)
		VALUES (?, ?, ?)";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->pseudo,MD5($this->mdp),$this->id));

		$requete2="SELECT * FROM enfant WHERE pseudo=?";
		$reponse2=$this->pdo->prepare($requete2);
		$reponse2->execute(array($this->pseudo));
		$enregistrements=$reponse2->fetchAll();
		return $enregistrements[0]['id'];
	}

	/**
	* Vérifie dans la table enfant de la base de donnée si le pseudo est déjà utilisé
	* Renvoie true s'il n'est pas déjà pris, false sinon
	*/

	public function verifier(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		$requete="SELECT * FROM enfant WHERE pseudo=?";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->pseudo));

		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();

		//connaitre le nombre d'enregistrements
		$nombrereponses=count($enregistrements);

		//tester si un enregistrement existe
		if ($nombrereponses > 0)
		{
			//Pseudo déjà utilisé
			return false;
		}
		else
		{
			return true;
		}

	}

	/**
	* Ajoute la limite de temps autorisé à la table plage_horaire de la base de données
	*/
	public function limitstime($id){
		$requete="INSERT INTO plage_horaire (id_enfant) VALUES (?)";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($id));
	}
}


?>
