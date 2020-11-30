<?php
class ModerButton extends View{
	private $id;
	private $idJeune;
	private $adresse;
	private $sujet;
	
	function __construct($id,$idJeune,$adresse,$suj){
		$this->id=$id;
		$this->idJeune=$idJeune;
		$this->adresse=$adresse;
		$this->sujet=$suj;
		$this->afficher_contenu();
	}
	
	function afficher_contenu(){
		$id=$this->id;
		$idJeune=$this->idJeune;
		$suj=$this->sujet;
		$target="#target".(string)$id;
		$t="target".(string)$id;
		if($this->adresse==1){
			$ad="index.php?enfant=9&n=2&mod=1&id=$id&idJeune=$idJeune";
		}
		else if ($this->adresse==2){
			$ad="index.php?enfant=9&n=3&mod=1&id=$id&idJeune=$idJeune&suj=$suj";
		}
		echo<<<TXT
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target=$target id="left">
		  Modérer
		</button>

		<!-- Modal -->
		<div class="modal fade" id=$t tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modérer ce commentaire</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<form action=$ad method="post">
				   <div class="form-group">
						<label for="motif">Motif de l'avertissement:</label>
						<input class="form-control" type="text" name="motif" id="motif">
					</div>
				  <button type="submit" class="btn btn-primary">Modérer</button>
				</form>
			  </div>
			</div>
		  </div>
		</div>
TXT;
	}
}

?>