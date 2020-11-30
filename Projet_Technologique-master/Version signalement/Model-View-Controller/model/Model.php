<?php 
/**
* Classe mère de toutes les classes du dossier model
*/
class Model{
	public $salutation;
	/** 
	*Fonction test
	*/
	public function __construct(){
		$this->salutation="Essai";
	}
	
	/**
	* Fonction test
	*/
	public function salutation(){
		return $this->salutation;
	}
}


?>
