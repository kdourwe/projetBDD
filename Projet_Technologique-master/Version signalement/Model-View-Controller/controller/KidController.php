<?php
/**#@+
* Controller dédié aux sessions enfants
*/
class KidController extends Controller{
	private $ajoute;
	/**#@+
	* Construit le controller suivant l'instruction recu
	*/

	function __construct($i){
		$this->ajoute=0;
		if ($i=='1'){
			$this->firstPage();
		}
		else if ($i=='2'){
			$this->forum();
		}
		else if($i=='3'){
			if(isset($_GET['n'])){
				$this->sujet($_GET['n']);
			}
			else{
				$this->forum();
			}
		}
		else if($i=='4'){
			if(isset($_GET['n'])){
				$idForum=$_GET['n'];
				$modelEnf=new AjoutComment();
				$getId=new GetId();
				$idEnf=$getId->get();
				$this->ajoute=$modelEnf->launch($idForum,$idEnf);
				$this->sujet($idForum);
			}
			else{
				$this->forum();
			}
		}
		else if($i=='5'){
			$this->ajoutForum();
		}
		else if ($i=='6'){
			$this->listArticle();
		}
		else if($i=='7'){
			if(isset($_GET['n'])){
				$this->article($_GET['n']);
			}
			else{
				$this->listArticle();
			}
		}
		else if($i=='8'){
			if(isset($_GET['n'])){
				$this->signale($_GET['n']);
			}
			else{
				$this->forum();
			}
		}
		else if($i=='9'){
			$rendLaMain=new AdminController($_GET['n']);
			if($_GET['n']=='3'){
				$this->sujet($_GET['suj']);
			}
			else if($_GET['n']=='6'){
				$this->listArticle();
			}
		}

	}

	/**#@+
	* Affiche la page de Bienvenue des enfants
	*/

	public function firstPage(){
		$welcome=new Bienvenu();
	}

	/**#@+
	* Récupére et affiche les différent forum
	*/

	public function forum(){
		$page=new Forum();
		//Ajouter les articles
		$modelSujet=new GetForum();
		$sujets=$modelSujet->get();
		$nbSujet=count($sujets);

		for($l=0; $l<$nbSujet; $l++){
			$crea=new GetPseudo();
			$createur=$crea->get($sujets[$l]['id_creator'],'Jeune');
			$page->sujet($sujets[$l],$createur);
		}

		$page->finTable();
		$page->afficher_pied();
	}

	/**#@+
	* récupère et affiche  les messages d'un sujet n
	*/

	public function sujet($n){
		$getForum=new GetSujet();
		$suj=$getForum->get($n);

		if($suj!=null){
			$getPseudo=new GetPseudo();
			$createur=$getPseudo->get($suj['id_creator'],'Jeune');
			$page=new Sujet($suj,$createur,$this->ajoute);
			$this->ajoute=0;
			$getComment=new GetComment();
			$commentaires=$getComment->get($suj['id']);
			$nbCom=count($commentaires);

			for($l=0; $l<$nbCom; $l++){
				$publieur=new GetPseudo();
				$pub=$publieur->get($commentaires[$l]['id_createur'],'Jeune');
				$page->commentaire($pub,$commentaires[$l]);
			}


			$page->ajout();
			$page->afficher_pied();
		}
		else{
			$this->forum();
		}
	}

	/**#@+
	* Ajoute un forum à la base de données
	*/

	public function ajoutForum(){
		$ajout=new AjoutForum();
		$getId=new GetId();
		$id=$getId->get();
		$idForum=$ajout->launch($id);
		$this->forum();
	}

	/**#@+
	* Récupre et afficge la liste des articles
	*/

	public function listArticle(){
		$modelArt=new GetAllArticles();
		$articles=$modelArt->get();
		$page=new ListArticle();
		$nbArt=count($articles);
		for($l=0; $l<$nbArt; $l++){
			$page->contenu($articles[$l]);
		}
		$page->finTable();
		$page->afficher_pied();
	}

	/**#@+
	* Récupere et affiche l'article n
	*/
	public function article($n){
		$model=new GetArticle();
		$monArticle=$model->get($n);
		$page=new Article($monArticle);
	}

	/**#@+
	* Met à jour la base de donnèes en marquant un commentaire signalées
	*/

	public function signale($n){
		$comment=new UpdateComment();
		$idSujet=$comment->launch($n);
		$this->sujet($idSujet);

	}

}


?>
