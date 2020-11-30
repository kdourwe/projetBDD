<?php
class Sujet extends View{
	private $enregistrement;
	private $creator;
	private $ajout;

	function __construct($enregistrement,$createur,$ajout){
		$this->enregistrement=$enregistrement;
		$this->creator=$createur;
		$this->ajout=$ajout;
		$this->afficher_tete();
		$this->afficher_contenu();
	}

	function afficher_contenu(){
		$this->menu=new Navbar();
		if($this->ajout > 0){
			$this->mess_ajout();
		}
		$this->titre();
	}

	public function commentaire($pseudo,$comment){
		$date=$comment['date'];
		$text=$comment['commentaire'];
		echo <<<TXT
		<table>
			<div class="card">
			  <div class="card-header">
				$pseudo le $date
TXT;
		if($_SESSION['admin']==1 || $_SESSION['admin']==2){
			$button=new ModerButton($comment['id'],$comment['id_createur'],2,$comment['id_forum']);
		}
		else{
			if($comment['signale']==0){
				$this->signaler($comment['id']);
			}
			else{
				$this->dejaSignale();
			}
		}

		echo <<<TXT
			  </div>
			  <div class="card-body">
				<p class="card-text">$text</p>
			  </div>
			</div>

TXT;

	}

	public function signaler($id){
		$target="#target".(string)$id;
		$t="target".(string)$id;
		echo<<<TXT
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target=$target id="left">
		  Signaler
		</button>

		<!-- Modal -->
		<div class="modal fade" id=$t tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Signaler ce commentaire</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<p>Si commentaire vous semble injurieux ou inapproprié vous pouvez le signaler afin que l'administrateur le vérifie.
				Voulez vous signaler ce commentaire?</p>
				<a class="btn btn-primary" href="index.php?enfant=8&n=$id" role="button">Oui, je souhaite signaler ce commentaire</a>
			  </div>
			</div>
		  </div>
		</div>
TXT;
	}

	public function dejaSignale(){
		echo<<<TXT
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#dejaSignale" id="left">
		  Ce commentaire a été signalé
		</button>

		<!-- Modal -->
		<div class="modal fade" id="dejaSignale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Signaler ce commentaire</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<p> Ce commentaire a été signalé par un utilisateur et est dans l'attente de vérification par un administrateur.
				Méfiez vous donc des informations qu'il contient.
				</p>
			  </div>
			</div>
		  </div>
		</div>
TXT;
	}



	public function titre(){
		$titre=$this->enregistrement['nom'];
		$date=$this->enregistrement['date_creation'];
		$crea=$this->creator;
		echo <<<TXT
		<h3>$titre</h3>
		<h6>Créé par $crea le $date</h6>
TXT;
}

	public function ajout(){
		$id=$this->enregistrement['id'];
		echo <<<TXT
		<div id='ajout'>
			<form action="index.php?enfant=4&n=$id" method="post">
			   <div class="form-group">
				<label for="comm"><h6>Ajouter un commentaire:</h6></label>
				<input class="form-control" type="text" name="comment" id="comm">
			  </div>
			  <button type="submit" class="btn btn-primary">Ajouter</button>
			</form>
		</div>
TXT;
	}

	public function mess_ajout(){
		if($this->ajout==3){
		echo <<<TXT
		<div class="alert alert-danger" role="alert">
			La publication de votre commentaire a été interdite car le contenu de ce dernier ne respecte pas le règlement de notre site.
		</div>
TXT;
		}
		else if($this->ajout==2){
		echo <<<TXT
		<div class="alert alert-warning" role="alert">
		  Votre commentaire est en attente de modération car l'analyse automatique de son contenu le considère suspect.
		</div>
TXT;
		}
		else if($this->ajout==1){
		echo <<<TXT
		<div class="alert alert-success" role="alert">
		  Votre commentaire a bien été ajouté.
		</div>
TXT;
		}
	}
}

?>
