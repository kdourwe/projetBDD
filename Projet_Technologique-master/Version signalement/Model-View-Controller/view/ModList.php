<?php
class  ModList extends view{

  function __construct(){
		$this->afficher_tete();
		$this->afficher_contenu();
	}

  function afficher_contenu(){
    $this->menu=new Navbar();
		$this->dbtTable();
  }

  function dbtTable(){
    echo <<<TXT
		<table>
			<tr>
				<th>Pseudonyme</th>
				<th>Nb Activités</th>
			</tr>
TXT;
  }

  function finTable(){
    echo <<<TXT
    </table>
TXT;
  }
  
  function moderateur($pseudo,$nbactivité,$id){
      echo <<<TXT
          <tr>
            <td>$pseudo</td>
            <td><a href="index.php?enfant=9&n=8&id=$id">$nbactivité</a></td>
          </tr>
TXT;
  }
  
}
?>
