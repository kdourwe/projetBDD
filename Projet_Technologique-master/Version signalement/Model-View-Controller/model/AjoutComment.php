<?php
/**
* Permet d'ajouter un commentaire à la base de données
*/
class AjoutComment extends Dbase{
	private $createur;
	private $idFor;
	private $com;
	private $verif;
	private $signale;
	private $moderation;
	private $idComment;
	private $nltk;

	/**
	* Enregistre les informations nécessaires dans les attributs
	* Récupère la valeur de fiabilité du commentaire (cf EssaiPython.php) et modifie les futures valeurs des champs 'moderation' et 'signale'en conséquence.
	* Lance la requête
	* Appelle la fonction de modération si nécessaire
	* Renvoie une valeur (3=Refusé; 2=A vérifier, 1=Accepté) pour le message à afficher (cf view/Sujet.php)
	*/
	public function launch($idForum,$idCreateur){
		$this->nltk=0.0;
		$this->signale=0;
		$this->moderation=0;
		$this->createur=$idCreateur;
		$this->idFor=$idForum;
		$this->com=$_POST['comment'];
		$this->verif=new EssaiPython($this->com);
		$rep=(float)$this->verif->getoutput();
		$this->nltk=$rep;
		if($rep==1.0){
			$this->moderation=1;
		}
		else if($rep>0.0){
			$this->signale=1;
		}
		$this->requete();

		if($this->moderation==1){
			$this->warning();
			return 3;
		}
		if($this->signale==1){
			return 2;
		}
		return 1;
	}

	/**
	* Récupère les commentaires déjà existants pour connaitre le futur id du commentaire
	* Ajoute le commentaire à la table comment_forum de la base de données
	* Met à jour la date de dernière publication dans le sujet dans la table forum de la base de données
	*/
	public function requete(){
		//On récupère le futur id du commentaire
		$requete3="SELECT * FROM comment_forum";
		$reponse3=$this->pdo->prepare($requete3);
		$reponse3->execute();

		//récupérer tous les enregistrements dans un tableau
		$enregistrements3=$reponse3->fetchAll();
		$this->idComment=count($enregistrements3)+1;

		// Ajout du commentaire
		$requete="INSERT INTO comment_forum (id_forum, id_createur, commentaire, moderation, date,signale,nltk_val)
		VALUES (?, ?, ?, ?, NOW(), ?,?)";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->idFor,$this->createur,$this->com, $this->moderation, $this->signale,$this->nltk));

		//Mise à jour last_publish
		$requete2="UPDATE forum
		SET last_publish=NOW()
		WHERE id=?";
		$reponse2=$this->pdo->prepare($requete2);
		$reponse2->execute(array($this->idFor));
	}

	/**
	* Crée un avertissement (Message automatique) pour le commentaire modéré (cf Moderation.php)
	*/
	public function warning(){
		$moder=new Moderation();
		$moder->signal($this->idComment,$this->createur,"Refus de l'algorithme de traitement automatique du langage",0);
	}

}


?>
