<?php 
class UpdateMdp extends Dbase{
	private $enfant;
	private $nvMdp;
	
	public function launch(){
		$this->nvMdp=$_POST['pseudo'];
		$this->enfant=$_POST['idEnf'];
		$this->requete();
	}
	
	public function requete(){
		
		// mise à jour du mot de passe
		$requete2="UPDATE enfant 
		SET pswd=?
		WHERE id=?";
		$reponse2=$this->pdo->prepare($requete2);
		$reponse2->execute(array(md5($this->nvMdp),$this->enfant));
	}
}


?>