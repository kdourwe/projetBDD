<?php
class FormNewMember extends View{
	public $boo;
	
	function __construct($boo){
		$this->boo=$boo;
		$this->afficher();
	}

	function afficher_contenu(){
		if ($this->boo){
			$this->erreur();
		}
		$this->enter_data();
	}
	
	public function erreur(){
		echo <<<TXT
		<div class="alert alert-danger" role="alert">
		  Ce pseudo est déjà pris, merci d'en choisir un autre.
		</div>
TXT;
	}
	
	function enter_data(){
		echo <<<TXT
		<div id="formNew">
		<form class="form-inline" action="index.php?parent=4" method="post">
		  <div class="form-group">
			<label for="Nom">Nom </label>
			<input type="text" class="form-control" name="Nom" id="Nom" aria-describedby="emailHelp" placeholder="Nom">
		  </div>
		  
		  <div>
		  <div class="form-group">
			<label for="Prenom">Prénom </label>
			<input type="text" class="form-control" name="Prenom" id="Prenom" aria-describedby="emailHelp" placeholder="Prénom">
		  </div>
		  </div>
		  
		  <div class="form-group">
			<label for="Email">Adresse Mail </label>
			<input type="email" class="form-control" name="Email" id="Email" aria-describedby="emailHelp" placeholder="Saisir une adresse mail">
		  </div>
		  
		  <div class="form-group">
			<label for="Pseudo">Pseudonyme </label>
			<input type="text" class="form-control" name="Pseudo" id="Pseudo" aria-describedby="emailHelp" placeholder="Pseudonyme">
		  </div>
		  
		  <div class="form-group">
			<label for="Password">Mot de Passe </label>
			<input type="password" class="form-control" name="mdp" id="Password" placeholder="Saisir un mot de passe">
		  </div>
		  
		  <div class="form-check" id="questCode">
			<input type="checkbox" class="form-check-input" id="conditions">
			<label class="form-check-label" for="conditions">J'ai lu et jaccepte les conditions d'utilisation</label>
		  </div>
		  <button type="submit" class="btn btn-primary">Valider</button>
		</form>
		</div>
TXT;
	}
	


}
?>