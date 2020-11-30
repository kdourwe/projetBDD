<?php 
class UpdatePseudo extends Dbase{
	private $enfant;
	private $nvPseudo;
	
	public function launch(){
		$this->nvPseudo=$_POST['pseudo'];
		$this->enfant=$_POST['idEnf'];
		if ($this->verifier()){
			$this->requete();
			return true;
		}
		else{
			return false;
		}
	}
	
	public function requete(){
		
		// mise à jour du pseudo
		$requete2="UPDATE enfant 
		SET pseudo=?
		WHERE id=?";
		$reponse2=$this->pdo->prepare($requete2);
		$reponse2->execute(array($this->nvPseudo,$this->enfant));
	}
	
	public function verifier(){
		// exécuter une requête MySQL de type SELECT.. WHERE
		$requete="SELECT * FROM enfant WHERE pseudo=?";
		$reponse=$this->pdo->prepare($requete);
		$reponse->execute(array($this->nvPseudo));
		
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