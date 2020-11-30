<?php
class SignalList extends View{

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
				<th>Pseudonyme</th>
				<th>Sujet forum</th>
				<th>Commentaire</th>
				<th>Modérer</th>
			</tr>
TXT;
	}
	
	public function finTable(){
		echo <<<TXT
		</table>
TXT;
}



	function comment($commentaire,$forum,$pseudo){
		$myComment=$commentaire['commentaire'];
		$id=$commentaire['id'];
		$idJeune=$commentaire['id_createur'];
		$sign=$commentaire['nltk_val'];
		$css='';
		if($sign==0.9){
			$css='niv9';
		}
		else if($sign==0.8){
			$css='niv8';
		}
		else if($sign==0.6){
			$css='niv6';
		}
		else if($sign==0.5){
			$css='niv5';
		}
		echo <<<TXT
			<tr id=$css >
				<td>$pseudo</td>
				<td>$forum</td>
				<td>$myComment</td>
				<td>
TXT;
		$button=new ModerButton($id,$idJeune,1,0);
		echo <<<TXT
				<a class="btn btn-success" href="index.php?enfant=9&n=2&mod=0&id=$id" role="button">Accepter</a></td>
			 </tr>

TXT;

	}


}
?>
