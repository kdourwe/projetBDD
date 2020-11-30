<?php 

abstract class View{
	
	function salutation($salut){
		echo $salut;
	}
	
	function button($texte){
		echo '<button type="button">'.$texte.'</button>';
	}
	
	function afficher_tete(){
		echo <<<TXT
		<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<title>Projet technologique </title>
		<link href="fond.css" rel="stylesheet" type="text/css" media="all" />

		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link href="fond.css" rel="stylesheet" type="text/css" media="all" />

	</head>
	<body>
	<section>
	<section id="page">
TXT;
	$header=new Entete();
	}
	
	function afficher_pied(){
		echo <<<TXT
			</section>
			</section>
		</body>
</html>
TXT;
	}
	
	abstract function afficher_contenu();
	
	public function afficher(){
		$this->afficher_tete();
		$this->afficher_contenu();
		$this->afficher_pied();
	}
}

	


?>