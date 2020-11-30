<?php
class MemberList extends View{

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
				<th>Parent</th>
				<th>Nb Avertissements</th>
				<th>Suspension</th>
TXT;
        if ($_SESSION['admin']==2){
				echo <<<TXT
                    <th>Modérateur</th>
TXT;
        }
        echo <<<TXT
            </tr>
TXT;
	}

	public function finTable(){
		echo <<<TXT
		</table>
TXT;
}



	function individu($identite,$parent){
		$id=$identite['id'];
		$pseudo=$identite['pseudo'];
		$idParent=$identite['parent'];
		$nbAvert=$identite['nbWarning'];
		echo <<<TXT
			<tr>
				<td>$pseudo</td>
				<td><a href="index.php?enfant=9&n=5&id=$idParent">$parent</a></td>
				<td><a href="index.php?enfant=9&n=4&id=$id">$nbAvert avertissements</a></td>
TXT;
		if ($identite['suspension']==0){
			echo <<<TXT
					<td><a href="index.php?enfant=9&n=1&sus=$id" class="btn btn-light">Suspendre</a></td>

TXT;
		}
		else if ($identite['suspension']==1){
			echo <<<TXT
					<td><a href="index.php?enfant=9&n=1&sus=$id'" class="btn btn-danger">Retirer suspension</a></td>

TXT;
		}
        if($_SESSION['admin']==2){
            if($identite['admin']==1){
                echo <<<TXT
					<td><a href="index.php?enfant=9&n=1&pse=$pseudo" class="btn btn-secondary"> Rétrograder</a></td>
					</tr>
TXT;
            }
            else {
                echo <<<TXT
					<td><a href="index.php?enfant=9&n=1&pse=$pseudo" class="btn btn-light"> Promouvoir</a></td>
					</tr>
TXT;
            }
        }
	}



}
?>
