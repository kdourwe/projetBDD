<?php
/**
* Permet de gérer la modération des commentaires
*/
class Moderation extends Dbase{
	private $idSuj;
	/**
	* Permet de modifier un commentaire dans la table 'comment_forum' de la base de données pour passer sa valeur de modération à 1
	* Récupère le contenu du commentaire et l'ajoute à la base de données de commentaires négatifs (cf AddBdd.php)
	*/
	public function requete(){
		// on modère le commentaire
		$requete2="UPDATE comment_forum
		SET moderation=1
		WHERE id=?";
		$reponse2=$this->pdo->prepare($requete2);
		$reponse2->execute(array($this->idSuj));

		//on récupère le commentaire pour l'ajouter à la BDD
		$requete="SELECT * FROM comment_forum WHERE id=?";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->idSuj));
		$enregistrements=$reponse->fetchAll();
		$com=$enregistrements[0]['commentaire'];
		$Bdd_insultes=new AddBdd($com);
	}


	/**
	* Modifie un commentaire dans la table 'comment_forum' de la base de données pour retirer son signalement
	*/
	public function unsignal($id,$idMod){
		//On retire le signalement du commentaire
		$requete2="UPDATE comment_forum
		SET signale=0 AND id_moderateur=?
		WHERE id=?";
		$reponse2=$this->pdo->prepare($requete2);
		$reponse2->execute(array($idMod,$id));
	}

	/**
	* Crée un avertissement dans la table 'avertissement' de la base de données
	* met à jour le nombre d'avertissements reçus par l'enfant
	*/
	public function signal($id,$idJeune,$motif,$idMod){
		$this->idSuj=$id;
		$this->requete();


		//On crée l'avertissement
		$requete="INSERT INTO avertissement (id_enfant,date,Motif,id_commentaire,id_moderateur)
		VALUES (?,NOW(),?,?,?)";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($idJeune,$motif,$id,$idMod));

		//Ajout à nombre avertissements
		$requete2="SELECT * FROM avertissement WHERE id_enfant=?";
		$reponse2=$this->pdo->prepare($requete2);
		$reponse2->execute(array($idJeune));
		$enregistrements=$reponse2->fetchAll();
		$nb=count($enregistrements);

		$requete3="UPDATE enfant
		SET nbWarning=?
		WHERE id=?";
		$reponse3=$this->pdo->prepare($requete3);
		$reponse3->execute(array($nb,$idJeune));

	}
}


?>
