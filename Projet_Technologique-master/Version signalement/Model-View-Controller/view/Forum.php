<?php
class Forum extends View{
	private $menu;
	
	function __construct(){
		$this->afficher_tete();
		$this->afficher_contenu();
	}
	
	function afficher_contenu(){
		$this->menu=new Navbar();
		$this->dbtTable();

	}
	
	public function dbtTable(){
		echo <<<TXT
		<table>
			<tr>
				<th>Nom</th>
				<th>Publié par</th>
				<th>Date de création</th>
				<th>Dernier ajout</th>
			</tr>
TXT;
	}
	public function finTable(){
		echo <<<TXT
		</table>
TXT;
		$this->ajout();
}
	
	
	
	function sujet($monsujet,$createur){
		$titre=$monsujet['nom'];
		$creation=$monsujet['date_creation'];
		$last=$monsujet['last_publish'];
		$id=$monsujet['id'];
		echo <<<TXT
			<tr>
				<td><a href="index.php?enfant=3&n=$id">$titre</a></td>
				<td>$createur</td>
				<td>$creation</td>
				<td>$last</td>
			 </tr>
			
TXT;
	}
	
	public function ajout(){
		echo <<<TXT
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Jeune" id="ajout">
		  Ajouter un sujet	</button>

		<!-- Modal -->
		<div class="modal fade" id="Jeune" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Ajouter un sujet sur le forum</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				
				<form action="index.php?enfant=5" method="post">
				   <div class="form-group">
						<label for="title">Titre du sujet:</label>
						<input class="form-control" type="text" name="titre" id="title">
					</div>
				  <button type="submit" class="btn btn-primary">Ajouter</button>
				</form>
			  </div>
			</div>
		  </div>
		</div>
		
TXT;
	}
	


}
?>