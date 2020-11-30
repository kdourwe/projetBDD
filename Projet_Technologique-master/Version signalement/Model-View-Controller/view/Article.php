<?php
class Article extends View{
	private $info;
	private $menu;
	
	function __construct($info){
		$this->info=$info;
		$this->afficher();
	}
	
	function afficher_contenu(){
		$this->menu=new Navbar();
		$this->contenu();

	}
	
	
	
	function contenu(){
		$titre=$this->info['nom'];
		$date=$this->info['creation'];
		$texte=$this->info['contenu'];
		echo <<<TXT
			<div class="card">
				<div class="card-header">
					<h3>$titre</h3>
				</div>
				<div class="card-body">
					<h6 class="card-title">Publié le $date</h6>
					<p class="card-text">$texte</p>
				</div>
			</div>
			
TXT;
	}
	


}
?>