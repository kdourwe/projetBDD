<?php
class Accueil extends View{
	private $refus;
	private	$suspension;
  private $notime;
  private $timeout;

	public function afficher_contenu(){
		$this->resume();
		if ($this->refus==true){
			$this->erreur();
		}
		if ($this->suspension==true){
			$this->interdit();
		}
        if($this->notime==true){
            $this->hconnection();
        }
        if($this->timeout==true){
            $this->end();
        }
		$this->qui();

	}

	public function denied($exit){
		$this->refus=$exit;
	}

	public function refus($exit){
		$this->suspension=$exit;
	}

    public function timeout($exit){
        $this->notime=$exit;
    }

    public function timepast($exit){
        $this->timeout=$exit;
    }

	public function erreur(){
		echo <<<TXT
		<div class="alert alert-danger" role="alert">
		  Désolé, les informations fournies ne nous a pas permis de vous identifier.
		</div>
TXT;
	}

	public function interdit(){
		echo <<<TXT
		<div class="alert alert-danger" role="alert">
		  La connexion vous a été refusée car vous êtes suspendu.
		</div>
TXT;
	}

    public function hconnection(){
        echo <<<TXT
        <div class="alert alert-danger" role="alert">
         Vous essayez de vous connecter en-dehors des horaires autorisées.
        </div>
TXT;
    }

    public function end(){
        echo <<<TXT
        <div class="alert alert-danger" role="alert">
         Votre temps de connexion est écoulé.
        </div>
TXT;
    }

	public function resume(){
		echo <<<TXT
		<div class="card text-center">
		  <div class="card-header">
			<h5 class="card-title">Bienvenue sur TeenShare</h5>
		  </div>
		  <div class="card-body">
			<h6 class="card-title">A quoi sert ce site?</h6>
			<p class="card-text">TeenShare est un site imaginé et développé
			pour les jeunes. Naviguer seul sur le web peut être dangereux
			pour les enfants et adolescents qui n'ont pas toujours conscience des
			dangers d'internet. L'objectif de TeenShare est d'offrir aux jeunes
			une plateforme de partage et d'information sûre.
			</p>
		  </div>
		</div>
TXT;
	}

	public function qui(){
		echo <<<TXT
		<div class="card text-center">
		  <div class="card-header">
			<h5 class="card-title">Qui êtes vous?</h5>
		  </div>
		  <div class="card-body">
TXT;
			$this->identifier();
		echo <<<TXT
		  </div>
		</div>
TXT;
	}

	public function identifier(){
		echo <<<TXT
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Parent">
		  Parent </button>

		<div class="modal fade" id="Parent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Connectez-vous</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">

				<form action="index.php?action=Parent" method="post">
				   <div class="form-group">
					<label>Pseudonyme:</label>
					<input class="form-control" type="text" name="pseudo" id="Pseudonyme">
				  </div>
				  <div class="form-group">
					<label for="pwd">Mot de passe:</label>
					<input type="password" name="mdp" class="form-control" id="pwd">
				  </div>
				  <button type="submit" class="btn btn-primary">Se connecter</button>
				</form>
			  </div>
			  <div class="modal-footer">
				<a href="index.php?action=NewParent"  role="button" aria-pressed="true">Je n'ai pas encore de compte</a>
			  </div>
			</div>
		  </div>
		</div>


		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Jeune">
		  Jeune	</button>

		<!-- Modal -->
		<div class="modal fade" id="Jeune" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Connectez-vous</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">

				<form action="index.php?action=Jeune" method="post">
				   <div class="form-group">
					<label>Pseudonyme:</label>
					<input class="form-control" type="text" name="pseudo" id="Pseudonyme">
				  </div>
				  <div class="form-group">
					<label for="pwd">Mot de passe:</label>
					<input type="password" name="mdp" class="form-control" id="pwd">
				  </div>
				  <button type="submit" class="btn btn-primary">Se connecter</button>
				</form>
			  </div>
			</div>
		  </div>

		</div>
TXT;
//<a class="btn btn-primary" href="index.php?python=1" role="button">python</a>
	}


}
?>
