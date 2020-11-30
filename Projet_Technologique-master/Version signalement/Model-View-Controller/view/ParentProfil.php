<?php
class ParentProfil extends View{
	private $pseudo;
	private $prenom;
	private $nom;
	private $email;
	private $inscription;
	private $etablissement;
	
	function __construct($identite, $etablissement){
		$this->pseudo=$identite['pseudo'];
		$this->prenom=$identite['prenom'];
		$this->nom=$identite['nom'];
		$this->email=$identite['email'];
		$this->inscription=$identite['date_inscrit'];
		$this->etablissement=$etablissement;
		$this->afficher_tete();
		$this->afficher_contenu($this->pseudo);
	}
	
	function afficher_contenu(){
		$pseudo=$this->pseudo;
		$this->menu=new Navbar();
		echo <<< TXT
		<h2>$pseudo</h2>
TXT;
		$this->presentation();
		$this->dbtTable();

	}
	
	public function presentation(){
		$prenom=$this->prenom;
		$nom=$this->nom;
		$email=$this->email;
		$inscri=$this->inscription;
		$etablissement=$this->etablissement;
		echo <<<TXT
		<table>
		<tr>
		<th>Prénom</th>
		<td>$prenom</td>
		</tr>
		<tr>
		<th>Nom</th>
		<td>$nom</td>
		</tr>
		<tr>
		<th>Email</th>
		<td>$email</td>
		</tr>
		<tr>
		<th>Inscription</th>
		<td>$inscri</td>
		</tr>
		<tr>
		<th>Origine du code</th>
		<td>$etablissement</td>
		</tr>
		</table>
TXT;
	}
	
	public function dbtTable(){
		echo <<<TXT
		<table>
			<tr>
				<th>Pseudo</th>
				<th>Nombre d'avertissements</th>
			</tr>
TXT;
	}
	public function finTable(){
		echo <<<TXT
		</table>
TXT;
}
	
	
	
	function enfant($enfant){
	$pseudo=$enfant['pseudo'];
	$nbWarn=$enfant['nbWarning'];
	$id=$enfant['id'];
		echo <<<TXT
			<tr>
				<td>$pseudo</td>
				<td><a href="index.php?enfant=9&n=4&id=$id">$nbWarn avertissements</a></td>
TXT;

	}
	


}
?>