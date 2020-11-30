<?php
class WarningList extends View{
	private $pseudo;
	
	function __construct($pseudo){
		$this->pseudo=$pseudo;
		$this->afficher_tete();
		$this->afficher_contenu($pseudo);
	}
	
	function afficher_contenu(){
		$pseudo=$this->pseudo;
		$this->menu=new Navbar();
		echo <<< TXT
		<h2>$pseudo</h2>
TXT;
		$this->dbtTable();

	}
	
	public function dbtTable(){
		echo <<<TXT
		<table>
			<tr>
				<th>Motif</th>
				<th>Date</th>
			</tr>
TXT;
	}
	public function finTable(){
		echo <<<TXT
		</table>
TXT;
}
	
	
	
	function warn($avertissement){
	$motif=$avertissement['Motif'];
	$date=$avertissement['date'];
		echo <<<TXT
			<tr>
				<td>$motif</td>
				<td>$date</td>
TXT;

	}
	


}
?>