<?php
class Changer extends View{
	private $i;
	private $id;
	
	function __construct($i,$id){
		$this->i=$i;
		$this->id=$id;
		$this->afficher_contenu();
	}
	
	function afficher_contenu(){
		$postId=$this->id;
		$str=(string)$postId;
		if($this->i==1){
			$target='#a'.$str;
			$t='a'.$str;
			$button='Changer Pseudo';
			$mess='Nouveau pseudonyme:';
			$nb=1;
		}
		elseif($this->i==2){
			$target='#b'.$str;
			$t='b'.$str;
			$button='Changer Mot de passe';
			$mess='Nouveau mot de passe:';
			$nb=2;
		}
        elseif($this->i==3){
            $target='#c'.$str;
            $t='c'.$str;
            $button='Changer Temps de Connexion';
            $mess='Nouveau temps de connexion:';
            $nb=6;
        }
        elseif($this->i==4){
            $target="#d".$str;
            $t='d'.$str;
            $button='Changer Horaires de Connexion';
            $mess='Nouveaux horaires de connexion: (exemple de format : 10-17)';
            $nb=7;
        }
        elseif($this->i==5){
            $target="#e".$str;
            $t='e'.$str;
            $button='Changer votre mot-de-passe';
            $mess='Nouveau mot-de-passe :';
            $nb=8;
        }
        elseif($this->i==6){
            $target="#g".$str;
            $t='g'.$str;
            $button='Changer votre email';
            $mess='Nouvel adresse mail :';
            $nb=9;
        }
		
		echo <<<TXT
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target=$target>
			 $button</button>

			<!-- Modal -->
			<div class="modal fade" id=$t tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">$button</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					
					<form action="index.php?parent=$nb" method="post">
					   <div class="form-group">
						<input type="hidden" name="idEnf" value=$postId />
						<label>$mess</label>
						<input class="form-control" type="text" name="pseudo" id="Pseudonyme">
					  </div>
					  <button type="submit" class="btn btn-primary">Changer</button>
					</form>
				  </div>
				</div>
			  </div>
			</div>
TXT;
	}
}

?>