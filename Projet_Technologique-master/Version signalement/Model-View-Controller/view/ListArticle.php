<?php
class ListArticle extends View{
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
				<th>Titre de l'article</th>
				<th>Date de publication</th>
			</tr>
TXT;
	}
	public function finTable(){
		echo <<<TXT
		</table>
TXT;
		if($_SESSION['admin']==1){
			$this->ajout();
		}
}
	
	
	
	function contenu($article){
	$titre=$article['nom'];
	$id=$article['id'];
	$date=$article['creation'];
		echo <<<TXT
			<tr>
				<td><a href="index.php?enfant=7&n=$id">$titre</a></td>
				<td>$date</td>
			 </tr>
			
TXT;
	}
	
	function ajout(){
				echo <<<TXT
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Jeune" id="ajout">
		  Ajouter un article	</button>

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
				
				<form action="index.php?enfant=9&n=6" method="post">
				   <div class="form-group">
						<label for="title">Titre de l'article:</label>
						<input class="form-control" type="text" name="title" id="title">
						<label for="contenu">Contenu de l'article:</label>
						<textarea class="form-control" name="contenu" id="contenu" rows="10"></textarea>
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