<?php
class Bienvenu extends View{
	private $menu;
	
	function __construct(){
		/*$this->afficher_tete();
		$this->afficher_contenu();*/
		$this->afficher();
	}
	
	function afficher_contenu(){
		$this->menu=new Navbar();
		$this->bienvenu();

	}
	
	function bienvenu(){
		$pseudo=$_SESSION['pseudo'];
		echo <<<TXT
			<div class="card text-center" id="carte">
			  <div class="card-header">
				<h4 class="card-title">Bienvenue $pseudo</h4>
			  </div>
			  <div class="card-body">
				<h6 class="card-title">Les dangers d'internet</h6>
				<p class="card-text">Ne divulgez jamais votre mot de passe ou d'autres informations personnelles comme votre adresse, votre identité ou votre numéro de téléphone.
				Si vous êtes victime ou témoin de harcèlement, contactez l'administrateur du site à l'adresse mail 'edwige.gros@etu.u-bordeaux.fr'. 
				Tout comportement nuisible pourra faire l'objet de modération ou d'expultion temporaire ou définitive.
				</p>
			  </div>
			</div>
TXT;
	}
	


}
?>