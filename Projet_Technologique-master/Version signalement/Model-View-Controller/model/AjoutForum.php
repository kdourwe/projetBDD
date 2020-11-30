<?php 
/**
* Permet d'ajouter un sujet de forum à la base de données
*/
class AjoutForum extends Dbase{
	private $createur;
	private $titre;
	
	/**
	* Enregistre les informations nécessaires dans les attributs
	* Lance la requête
	* Appelle la fonction nbFor et renvoie sa valeur
	*/
	public function launch($id){
		$this->createur=$id;
		$this->titre=$_POST['titre'];
		$this->requete();
		return $this->nbFor();
	}
	
	/**
	* Ajoute le sujet à la table forum de la base de données
	*/
	public function requete(){
		
		// Ajout du commentaire
		$requete="INSERT INTO forum (nom, id_creator, last_publish, date_creation, moderation) 
		VALUES (?, ?, NOW(), NOW(), 0)";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->titre,$this->createur));
	}
	
	/**
	* Renvoie l'id du nouveau sujet
	*/
	public function nbFor(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		$requete="SELECT * FROM forum";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute();
		
		//récupérer tous les enregistrements dans un tableau
		$enregistrements=$reponse->fetchAll();
		
		$nb=count($enregistrements)-1;
		
		return $nb;
	}

}


?>
