<?php
class WelcomeParent extends View{
    private $menu;
	private $ajout;
	private $nvPseud;
	private $nvMdp;
    private $nvTimeC;
    private $nvlimitsC;

	function __construct($ajout,$nvPseud,$nvMdp,$nvTimeC, $nvlimitsC){
		$this->ajout=$ajout;
		$this->nvPseud=$nvPseud;
		$this->nvMdp=$nvMdp;
        $this->nvTimeC=$nvTimeC;
        $this->nvlimitsC=$nvlimitsC;
		$this->afficher_tete();
		$this->afficher_contenu();
	}

	function afficher_contenu(){
		if ($this->ajout==false){
			$this->erreur();
		}
		if ($this->nvPseud!=null){
			$this->feedbackPseudo();
		}
		if ($this->nvMdp!=null){
			$this->feedbackMdp();
		}
        if($this->nvTimeC!=null){
            $this->feedbackTimeC();
        }
        if($this->nvlimitsC!=null){
            $this->feedbacklimitsC();
        }
		$this->bienvenu();

	}

	public function erreur(){
		echo <<<TXT
		<div class="alert alert-danger" role="alert">
		  Echec de l'ajout d'un enfant: Ce pseudo est déjà pris, merci d'en choisir un autre.
		</div>
TXT;
	}

	public function feedbackPseudo(){
		if($this->nvPseud){
			echo <<<TXT
			<div class="alert alert-success" role="alert">
			  Pseudo mis à jour avec succès.
			</div>
TXT;
		}
		else{
			echo <<<TXT
		<div class="alert alert-danger" role="alert">
		  Echec de la mise à jour du pseudo: Ce pseudo est déjà pris, merci d'en choisir un autre.
		</div>
TXT;
		}
	}

	public function feedbackMdp(){
			echo <<<TXT
			<div class="alert alert-success" role="alert">
			  Mot de passe mis à jour avec succès.
			</div>
TXT;
	}

    public function feedbackTimeC(){
        echo <<<TXT
        <div class="alert alert-success" role="alert">
         Temps de connexion mis à jour avec succès.
        </div>
TXT;
    }

    public function feedbacklimitsC(){
        echo <<<TXT
        <div class="alert alert-success" role="alert">
         Horaires de connexion mis à jour avec succès.
        </div>
TXT;
    }

	function bienvenu(){
		$pseudo=$_SESSION['pseudo'];
		echo <<<TXT
			<div class="card text-center" id="carte">
			  <div class="card-header">
				<h4 class="card-title">Bienvenue $pseudo</h4>
			  </div>
			  <div class="card-body">
				<p class="card-text">Depuis cette page vous pouvez consulter le statut de vos enfants et en ajouter de nouveaux.
				</p>
			  </div>
			</div>
TXT;
         $this->parentprofil();
         echo <<<TXT
			<h3>Mes enfants :</h3>
TXT;
	}

	public function afficher_enfant($kid,$time_limits){
		$pseudo=$kid['pseudo'];
		$idEnf=$kid['id'];
		$nb=$kid['nbWarning'];
    $time=date("H:i",strtotime("today ".$kid['timer_max'].":00:00"));
    $heure_dbt=$time_limits['heure_dbt'];
    $dt_limits=date("H:i",strtotime("today ".$heure_dbt.":00:00"));
    $ft_limits=date("H:i",strtotime("today ".$time_limits['heure_fin'].":00:00"));
		$idCo=11+$idEnf;

		echo <<<TXT
			<div class="card" id="carte">
			  <div class="card-header">
				<b>$pseudo</b>
					<div>
					<a href="index.php?parent=$idCo" class="card-link"> Listes connexions </a>
          <a href="index.php?parent=10&kid=$idEnf" class="card-link"> Messages signalés</a>
					</div>
			  </div>
			  <div class="card-body">
			  <p>Nombre d'avertissements reçus : $nb </p>
        <p>Temps de connexion autorisé : $time </p>
TXT;
		if($kid['suspension']==1){
			echo <<<TXT
			<div class="alert alert-danger" role="alert">
			  Votre enfant est actuellement suspendu du site suite à un comportement inapproprié.
			</div>
TXT;
		}
        else{
            echo <<<TXT
              <p>Ses horaires de connexion : $dt_limits - $ft_limits</p>
TXT;
        }
			$a=new Changer(1,$idEnf);
			$a=new Changer(2,$idEnf);
      $a=new Changer(3,$idEnf);
      $a=new Changer(4,$idEnf);
		echo <<<TXT
			  </div>
			</div>

TXT;
	}

	public function ajouter(){
		echo <<<TXT
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Jeune">
		  Ajouter un enfant	</button>

		<!-- Modal -->
		<div class="modal fade" id="Jeune" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Ajouter un enfant</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">

				<form action="index.php?parent=3" method="post">
				   <div class="form-group">
					<label>Son pseudonyme:</label>
					<input class="form-control" type="text" name="pseudo" id="Pseudonyme">
				  </div>
				  <div class="form-group">
					<label for="pwd">Son mot de passe:</label>
					<input type="password" name="mdp" class="form-control" id="pwd">
				  </div>
				  <button type="submit" class="btn btn-primary">Ajouter</button>
				</form>
			  </div>
			</div>
		  </div>
		</div>
TXT;
	}

    function parentprofil(){
        $idm=$_SESSION['id'];
        echo <<<TXT
          <h3> Mon profil:</h3>
          <div class="card-body">

TXT;
           $a=New Changer(5,$idm);
           $a=New Changer(6,$idm);
        echo <<<TXT
          </div>
TXT;

    }


}
?>
