<?php

/**#@+
* Controller de la partie administrateur
*/

class AdminController extends Controller{

/**#@+
* Construit le controller suivant l'instruction recu
*/

	function __construct($i){
		if ($i=='1'){
			if(isset($_GET['sus'])){
				$this->suspend($_GET['sus']);
			}
            if(isset($_GET['pse'])){
				$this->moderation($_GET['pse']);
			}
			$this->membres();
		}
		else if ($i=='2'){
			if(isset($_GET['mod'])){
				$mod=$_GET['mod'];
				if($mod=='0'){
					$this->unsignaled($_GET['id']);
				}
				else{
          $this->warning($_GET['id'],$_GET['idJeune'],$_POST['motif']);
				}
			}
			$this->comSignale();
		}
		else if ($i=='3'){
			if(isset($_GET['mod'])){
				$mod=$_GET['mod'];
				if($mod=='1'){
					$this->warning($_GET['id'],$_GET['idJeune'],$_POST['motif']);
				}
			}
		}
		else if ($i=='4'){
			if(isset($_GET['id'])){
				$id=$_GET['id'];
				$this->avert($id);
			}
		}
		else if ($i=='5'){
			if(isset($_GET['id'])){
				$id=$_GET['id'];
				$this->parentProfil($id);
			}
		}
		else if ($i=='6'){
			if(isset($_POST['title']) && isset($_POST['contenu'])){
				$title=$_POST['title'];
				$contenu=$_POST['contenu'];
				$this->newArticle($title,$contenu);
			}
		}
    else if(($i=='7')){
        $this->moderateur();
    }
    else if ($i=='8'){
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $this->activitemoderateur($id);
        }
      }
      else if ($i=='9'){
          if(isset($_GET['com'])){
              $id_com=$_GET['com'];
              $dec=$_GET['dec'];
              $this->updateMod($id_com,$dec);
          }
          $this->contestation();
      }
    }


/**#@+
* Récupère puis affiche tout les menbres inscrit dans la base de donnèes (leur parent, nombres d'avertissements, s'ils sont suspendus et leur status)
*/

	function membres(){
		//On récupère la liste des membres enfants
		$modelMember=new GetAllMembers();
		$listMembres=$modelMember->get('Jeune');

		//On crée la vue
		$viewMember=new MemberList();

		//Affichage de chaque membre dans le tableau
		$nbMembres=count($listMembres);
		for($l=0; $l<$nbMembres; $l++){
			//On récupère l'identité du parent
			if ($listMembres[$l]['admin']==0 ||($_SESSION['admin']==2 && $listMembres[$l]['admin']==1)){
				$modelGetParent=new GetPseudo();
				$parent=$modelGetParent->get($listMembres[$l]['parent'],'Parent');

				//Affichage du membre
				$viewMember->individu($listMembres[$l],$parent);
			}

		}
		//On affiche la fin de la page
		$viewMember->finTable();
	}

/**#@+
* Change la suspension de l'enfant id. S'il était suspendu, il ne l'ai plus et inversement.
*/

	function suspend($id){
		$modelSuspend=new AlterSuspension();
		$modelSuspend->change($id);
	}

/**#@+
* Récupère puis affiche les commentaires signalés des forums
*/

	function comSignale(){
		$modelSignalement=new GetSignalement();
		$mesSignalements=$modelSignalement->requete();
		$nbSign=count($mesSignalements);

		$view=new SignalList();
		for($l=0;$l<$nbSign;$l++){
			//On récupère le pseudo du jeune
			$modelPseudo=new GetPseudo();
			$pseudo=$modelPseudo->get($mesSignalements[$l]['id_createur'], 'Jeune');
			//On récupère le titre du sujet de forum
			$modelSujet=new GetSujet();
			$sujet=$modelSujet->get($mesSignalements[$l]['id_forum']);
			//On affiche la ligne
			$view->comment($mesSignalements[$l],$sujet['nom'],$pseudo);
		}
		$view->finTable();
	}

	/**#@+
	* Enlever le signalement d'un commentaire signalés à tord
	*/

	function unsignaled($id){
		$modelModer=new Moderation();
		$modelGetId=new GetId();
		$idMod=$modelGetId->get();
		$modelModer->unsignal($id,$idMod);
	}

	/**#@+
	* Ajouter un message considèrer inapproprier à avertissements
	*/

	function warning($id,$idJeune,$motif){
		$modelModer=new Moderation();
		$modelGetId=new GetId();
		$idMod=$modelGetId->get();
		$modelModer->signal($id,$idJeune,$motif,$idMod);
	}

	/**#@+
	* Récupere et affiche les messages signalés
	*/

	function avert($id){
		$modelWarning= new GetWarning();
		$warnings=$modelWarning->get($id);
		$nbWarning=count($warnings);

		$modelPseudo=new GetPseudo();
		$pseudo=$modelPseudo->get($id,'Jeune');

		$view=new WarningList($pseudo);
		for ($l=0; $l<$nbWarning; $l++){
			$view->warn($warnings[$l]);
		}
		$view->finTable();

	}

	/**#@+
	* récupère et affiche les informations relative aux parent d'un enfant id
	*/

	function parentProfil($id){
		//Obtenir le profil du parent
		$modelProfil=new GetProfil();
		$identite=$modelProfil->get($id);
		//Obtenir le nom de l'établissement d'où provient le code
		$modelEtab=new GetEtalissement();
		$etablissement=$modelEtab->get($identite['code']);
		//Obtenir la liste des enfants du parent
		$modelKids=new MyKids();
		$kids=$modelKids->get($id);
		$nbKid=count($kids);

		$view=new ParentProfil($identite,$etablissement);
		for($l=0;$l<$nbKid;$l++){
			$view->enfant($kids[$l]);
		}
		$view->finTable();
	}

	/**#@+
	* Ajoute l'article à la base de donnèes
	*/

	function newArticle($title,$contenu){
		$modelArticle=new AddArticle();
		$modelArticle->launch($title,$contenu);
	}

	/**#@+
	* Actualise le status d'un enfant. S'il était modérateur, il perd ses droits.
	*/

	function moderation($pseudo){
		$modelMod = new ModerationMod();
    $modelMod->launch($pseudo);
	}

	/**#@+
	* Récupere et affiche la liste des modèrateurs et le compte de leurs activités
	*/

    function moderateur(){
        $modelMember=new GetAllMembers();
				$listMembres=$modelMember->get('Jeune');

        $viewMod=new ModList();
        $nbMembres=count($listMembres);
				for($l=0; $l<$nbMembres; $l++){
            if($listMembres[$l]['admin']==1){
                $modelActivite=new ListCommentModerer();
                $listActivité=$modelActivite->launch($listMembres[$l]['id']);
                if($listActivité==null){
                    $nbactivite=0;
                }
                else{
                    $nbactivite=count($listActivité);
                }
                $viewMod->moderateur($listMembres[$l]['pseudo'], $nbactivite, $listMembres[$l]['id']);
            }
        }
        $viewMod->finTable();
    }

		/**#@+
		* recupère et affiche les activité d'un modèrateur id
		*/

    function activitemoderateur($id){

        $modelActivite=new ListCommentModerer();
        $viewActivite= new ListActiviteMod();
        $listActivité=$modelActivite->launch($id);
        if($listActivité==null){
            $nbactivite=0;
        }
        else{
            $nbactivite=count($listActivité);
        }
        if ($nbactivite>0){
            for($l=0; $l<$nbactivite; $l++){
                $modelComment=new GetAllComment();
				$Motif=$modelComment->get($listActivité[$l]['id']);
                if($listActivité[$l]['moderation']=='0'){
                    $decision="Accepter";
                }
                else{
                    $decision="Moderer";
                }
                $viewActivite->getComment($listActivité[$l]['commentaire'],$listActivité[$l]['date'],$decision,$Motif[$l]['Motif']);
            }
        }
        $viewActivite->finTable();
    }

		/**#@+
		* Récupère et affiche la liste des message contesté
		*/

    function contestation(){
        $modelContestation=new GetContestation();
        $viewContestation=new AdminContestation();
        $listContestation=$modelContestation->get();
        if($listContestation!=null){
            $nbContestation=count($listContestation);
            for($l=0;$l<$nbContestation;$l++){
                $modelComment=new Comments();
				$Motif=$modelComment->get($listContestation[$l]['id_commentaire']);
                $viewContestation->message($Motif['commentaire'],$listContestation[$l]['Motif'],$listContestation[$l]['id_commentaire']);
            }
        }
        $viewContestation->fin_tab();
    }

		/**#@+
		* Actualise le status d'un commentaire contester. S'il a été jugé inaproprié, la modèration restera effective.
		*/

    function updateMod($id_com,$dec){
        $modelUpdate= new UpdateComments();
        $modelUpdate->launch($id_com,$dec);
    }
}


?>
