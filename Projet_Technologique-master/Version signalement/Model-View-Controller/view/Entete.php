<?php
class Entete extends View{
	function __construct(){
		$this->afficher_contenu();
	}
	
	function afficher_contenu(){
		echo <<<TXT
		<header  id="hautdepage">
TXT;
		if(isset($_SESSION['pseudo']) && $_SESSION['pseudo']!=null && isset($_GET['deco'])==false){
			echo <<<TXT
			<a href="index.php?deco=1">Déconnexion</a>
TXT;
		}
		echo <<<TXT
			<div id="title">
			<p id="titre">TeenShare</p>
			</div>
		</header>
TXT;
	}
}

?>