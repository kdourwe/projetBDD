<?php

/**#@+
* Controller pour l'inscription d'un nouveau parent
*/

class NewParent extends Controller{
	public $code;
	public $page;
	public $id;
	//public $variable;

	/**#@+
	* Verifie le code donnés par le parent et lance la procèdure d'inscription
	*/

	function __construct(){
		if(isset($_POST['code'])){
			$this->code=$_POST['code'];
			$verif=new CheckCode();
			if($verif->verifier($this->code)){
				$_SESSION['code'] = $this->code;
				$this->page=new FormNewMember(false);
			}
			else{
				$this->page=new NewMember(true);
			}
		}
		else{
			$this->page=new NewMember(false);
		}
	}
}
?>
