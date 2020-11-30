<?php

/**#@+
* Controller de l'acceuil du site
*/

class Controller{
	public $accueil;
	public $model;
	public $id;
	//public $variable;

	/**#@+
	* Crée la vue et le model de l'acceuil du site
	*/

	function __construct(){
		$this->accueil=new Accueil();
		$this->model=new Model();
		$this->variable="";
	}

	/**#@+
	* Redirige vers l'acceuil si les informations données sont inconnu de la base de données.
	* Sinon redirige vers le controller correspondant au status de la personne connecté.
	* Nettoie les paramètre de la session en cas de déconnexion
	*/

	function launch(){
		//Page par défaut
		if(isset($_GET['python'])){
			$var = new EssaiPython("Espèce de panoufle mal élevée.");
			$retour =$var->getoutput(); //(float)$var->getoutput();
			echo $retour;
		}

		else{
		if (isset($_GET['action'])==FALSE && isset($_GET['parent'])==FALSE && isset($_GET['enfant'])==FALSE){
			$this->accueil->denied(false);
			$this->accueil->afficher();
		}
		//Enregistrement
		if(isset($_GET['action'])){
			if($_GET['action']=='NewParent'){
				$newP=new NewParent();
			}
			else{
				$sign=new SigninController($this->accueil,$_GET['action']);
			}
		}
		if(isset($_GET['parent'])){
			$instruction=$_GET['parent'];
			$page=new ParentController($instruction);
		}

		if (isset($_GET['enfant'])){
			$instruction=$_GET['enfant'];

		    	if ($_SESSION['admin']!=1 && $_SESSION['timer_max']-strtotime("now")<=0){
		        	$this->accueil->timepast(true);
		        	$this->accueil->afficher();
		    	}
		    	else{
		        	$page=new KidController($instruction);
		    	}

		}

		if(isset($_GET['deco'])){
			$_SESSION['pseudo']=null;
			if($_SESSION['status']=='Jeune'){
				$_SESSION['admin']=null;
				$_SESSION['timer_max']=null;
				$_SESSION['code']=null;
			}
            else{
                $_SESSION['id']=null;
            }
			$_SESSION['status']=null;
		}
	}//
	}
}
?>
