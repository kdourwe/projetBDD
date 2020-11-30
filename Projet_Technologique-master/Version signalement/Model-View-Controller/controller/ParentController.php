<?php
class ParentController extends Controller{
	private $children;
	private $nbKids;
	private $ajoutSuccess;
	private $nvPseudo;
	private $nvMdp;
  private $nvTimeC;
  private $nvlimitsC;

	function __construct($instruction){
		$this->ajoutSuccess=true;
		$this->nvMdp=null;
		$this->nvPseudo=null;
        $this->nvTimeC=null;
        $this->nvlimitsC=null;
		if($instruction=='1'){
			$this->chgPseudo();
		}
		else if ($instruction=='2'){
			$this->chgMdp();
		}
		else if ($instruction=='3'){
			$this->ajout();
		}
		else if ($instruction=='4'){
			$this->nvParent();
		}
		else if ($instruction=='5'){
			$this->firstPage();
		}
    elseif($instruction=='6'){
        $this->chgTimeC();
    }
    elseif($instruction=='7'){
        $this->chglimitsC();
    }
    elseif($instruction=='8'){
        $this->chgMdpParent();
    }
    elseif($instruction=='9'){
        $this->chgMail();
    }
		elseif($instruction=='10'){
            if(isset($_GET['cont'])){
                $this->ChoixContestation($_GET['cont'],$_GET['kid']);
            }
			$this->messagecontester($_GET['kid']);
		}
		elseif($instruction>'11'){
			$this->ConnexionPage($instruction);
		}
	}

	public function getKids(){
		$getid=new GetId();
		$id=$getid->get();
		$mykids=new MyKids();
		$this->children=$mykids->get($id);
	}

	public function firstPage(){
		$this->getKids();
		$this->nbKids=count($this->children);
		$welcome=new WelcomeParent($this->ajoutSuccess, $this->nvPseudo,$this->nvMdp,$this->nvTimeC,$this->nvlimitsC);
		for ($i=0; $i <$this->nbKids; $i++){
            $GPH= new GetPHoraire();
            $timelimits=$GPH->get($this->children[$i]['id']);
			$welcome->afficher_enfant($this->children[$i],$timelimits);
		}
		$welcome->ajouter();
		$welcome->afficher_pied();
	}

	public function chgPseudo(){
		$model=new UpdatePseudo();
		$this->nvPseudo=$model->launch();
		$this->firstPage();
	}

	public function chgMdp(){
		$model=new UpdateMdp();
		$model->launch();
		$this->nvMdp=true;
		$this->firstPage();
	}

    public function chgTimeC(){
        $model=new UpdateTimeConnexion();
        $model->launch();
        $this->nvTimeC=true;
        $this->firstPage();

    }

    public function chglimitsC(){
        $model=new Updateplagehoraire();
        $model->launch();
        $this->nvlimitsC=true;
        $this->firstPage();
    }

	public function ajout(){
		$getId=new GetId();
		$myId=$getId->get();
		$ajout=new AjoutEnfant();
		$this->ajoutSuccess=$ajout->launch($myId);
		$this->firstPage();
	}

	public function nvParent(){
		$modelAj=new AjoutParent();
		$p=$modelAj->launch();
		if($p){
			$this->firstPage();
		}
		else{
			$this->page=new FormNewMember(true);
		}
	}

	public function ConnexionPage($instruction){
		$this->page=new ListeConnexion();
		$this->model= new GetKidConnexion();
		$KidId=$instruction-11;
		$trace=$this->model->get($KidId);
		if($trace!=0){
			$nbtrace=count($trace);
			for($i=0;$i<$nbtrace;$i++){
				$connexion=$trace[$i]['Connexion'];
				if ($trace[$i]['Autorisation']==0){
					$this->page->contenu(date("d-m-Y",$connexion),date("H:i:s",$connexion));
				}
				else{
						$this->page->warning_contenu(date("d-m-Y",$connexion),date("H:i:s",$connexion));
				}
			}
		}

		$this->page->fin_tab();
		$this->page->afficher_pied();
	}

    function chgMdpParent(){
        $model = new UpdateMdpParent();
        $model->launch();
		$this->firstPage();
    }

    function chgMail(){
        $model = new UpdateMail();
        $model->launch();
        $this->firstPage();
    }

		public function messagecontester($id_enfant){
        $viewM = new MessageContester();
				$modelM = new GetToContest();
				$listMessage=$modelM->get($id_enfant);
				if($listMessage!=null){
					$lim=count($listMessage);
					for($l=0;$l<$lim;$l++){
                        $message=$modelM->launch($listMessage[$l]['id']);
                        if($listMessage[$l]['id_moderateur']=="0" && $listMessage[$l]['Contester']=="-1"){
                            $viewM->message($message['commentaire'],$listMessage[$l]['Motif'],$id_enfant);
                        }
                        else{
                            if ($listMessage[$l]['Contester']=='1'){
                                $viewM->demandeencour($message['commentaire'],$listMessage[$l]['Motif']);
                            }
                            else{
                                $viewM->nointervention($message['commentaire'],$listMessage[$l]['Motif']);
                            }
                        }

					}
				}
        $viewM->fin_tab();
    }
        public function ChoixContestation($dec,$kid){
            $modelC=new ChoixContestation();
            $modelC->launch($dec,$kid);
        }

}
?>
