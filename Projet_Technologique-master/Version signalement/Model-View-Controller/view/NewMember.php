<?php
class NewMember extends View{
	private $i;
	
	function __construct($i){
		$this->i=$i;
		$this->afficher();
	}

	function afficher_contenu(){
		if($this->i){
			$this->erreur();
		}
		$this->explain();
		$this->ask_for_code();
	}
	
	public function erreur(){
		echo <<<TXT
		<div class="alert alert-danger" role="alert">
		  Ce code est déjà pris, renseignez vous auprès de l'établissement qui vous l'a fourni pour en obtenir un autre.
		</div>
TXT;
	}
	
	function ask_for_code(){
		echo <<<TXT
		<div>
		<form class="form-inline" action="index.php?action=NewParent" method="post">
		  <div class="form-group">
			<label for="inputPassword6">Rentrez votre code d'inscription :</label>
			<input type="password" id="inputPassword6" class="form-control mx-sm-3" aria-describedby="passwordHelpInline" name="code">
		  </div>
		  <div>
		  <button type="submit" class="btn btn-primary">Valider</button>
		  </div>
		</form>
		</div>
TXT;
	}
	

	
	function explain(){
		echo <<<TXT
		<div id="questCode">
		<p>
		  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#explanation" aria-expanded="false" aria-controls="explanation">
			A quoi correspond le code que l'on me demande?
		  </button>
		</p>
		<div class="collapse" id="explanation">
		  <div class="card card-body">
			Ce code est donné aux parents par des établissements reconnus par l'état tels que des établissements scolaires, des clubs sportifs ou des centres de jeunesse.
		  </div>
		</div>
		</div>
TXT;
	}


}
?>