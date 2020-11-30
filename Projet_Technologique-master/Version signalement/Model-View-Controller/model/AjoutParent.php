<?php 
/**
* Permet d'ajouter un profil parent à la base de données
*/
class AjoutParent extends Dbase{
	private $pseudo;
	private $nom;
	private $prenom;
	private $email;
	private $mdp;
	private $code;
	
	/**
	* Enregistre le titre et le contenu de l'article dans les attributs.
	* Appelle la fonction verifier(), si elle renvoie True:
	*     Lance la requête et renvoie true
	* Sinon renvoie false
	*/
	public function launch(){
		$this->pseudo=$_POST['Pseudo'];
		$this->nom=$_POST['Nom'];
		$this->prenom=$_POST['Prenom'];
		$this->email=$_POST['Email'];
		$this->mdp=$_POST['mdp'];
		if($this->verifier()){
			$this->requete();
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	* Récupère l'id du code permettant de créer le compte
	* Ajoute le profil du parent à la table parent de la base de données
	* Met à jour la table code dans la base de données pour marquer le code comme pris
	*/
	public function requete(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		$requete="SELECT * FROM code WHERE mycode=?";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($_SESSION['code']));
		
		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();

		$idcode=$enregistrements[0]['id'];
		
		// exécuter une requête MySQL de type SELECT.. WHERE
		$requete="INSERT INTO parent (prenom, nom, email, pseudo, pswd, code,date_inscrit) 
		VALUES (?, ?, ?, ?, ?,?, NOW())";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->prenom,$this->nom,$this->email,$this->pseudo,MD5($this->mdp),$idcode));
		
		//Marquer le code comme pris
		$requete2="UPDATE code 
		SET pris=1
		WHERE mycode=?";
		$reponse2=$this->pdo->prepare($requete2);
		$reponse2->execute(array($_SESSION['code']));
		
		
		$_SESSION['pseudo']=$this->pseudo;
		$_SESSION['status']='Parent';
		
		
	}
	
	/**
	* Vérifie si le code n'est pas déjà pris, renvoie false si c'est le cas
	*/
	public function verifier(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		$requete="SELECT * FROM parent WHERE pseudo=?";
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
}


?>
