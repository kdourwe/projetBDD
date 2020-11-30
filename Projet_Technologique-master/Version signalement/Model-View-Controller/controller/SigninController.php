<?php

/**#@+
* Controler d'identification
*/

class SigninController extends Controller{
	public $accueil;
	public $identite;

	/**#@+
	* construit l'onglet de connexion
	*/

	function __construct($accueil,$status){
		$this->accueil=$accueil;
		$this->send($status);
	}

	/**#@+
	* Récupère toute les donnèes lièes à la personne pseudo.
	* Autorise la connexion si les informations sont correcte, la refuse sinon
	*/

	public function send($status){
		$mdp=$_POST['mdp'];
		$pseudo=$_POST['pseudo'];
		$result=new Check();
		if(($this->identite=$result->verifier($mdp, $pseudo,$status))!=null){
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['status'] = $status;
			if ($status=='Jeune'){
				$_SESSION['admin']=$this->identite['admin'];
				$Connection = new NewKidConnection();
        $_SESSION['timer_max']=strtotime("now + ".$this->identite['timer_max']."hour");
        $modSusp=new IsSuspend();
        $getPH=new GetPHoraire();
        $PHoraire = $getPH->get($this->identite['id']);
        $now=strtotime("now");
				if($suspension=$modSusp->get()){
					$Connection->launch($this->identite['id'],1);
					$_SESSION['pseudo']=null;
					$_SESSION['status']=null;
					$_SESSION['code']=null;
					$this->accueil->refus(true);
					$this->accueil->afficher();
				}
        elseif($_SESSION['admin']==0&&(strtotime("today ".$PHoraire['heure_dbt'].":00:00")-$now>0 || $now-strtotime("today ".$PHoraire['heure_fin'].":00:00")>0)){
					$Connection->launch($this->identite['id'],1);
					$_SESSION['pseudo']=null;
					$_SESSION['status']=null;
					$_SESSION['code']=null;
					$this->accueil->timeout(true);
					$this->accueil->afficher();
				}
				else{
					$Connection->launch($this->identite['id'],0);
					$welcome=new Bienvenu();
				}
			}
			else{
                $_SESSION['id']=$this->identite['id'];
				$welcome=new ParentController('5');
			}
		}
		else{
			$this->accueil->denied(true);
			$this->accueil->afficher();
		}
	}
}


?>
