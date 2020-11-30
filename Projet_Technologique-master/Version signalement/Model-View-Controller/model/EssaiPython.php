<?php
/**
* Permet de lancer le script Python de Traitement du Langage
*/
class EssaiPython extends Model{
   private $output;
  /**
  * Rédige le commentaire dans un fichier txt
  * Lance le script python
  */
  public function __construct($entre){
    $myfile=fopen("monCommentaire.txt","w");
    fwrite($myfile,$entre);
    fclose($myfile);
    
    $this->output=shell_exec("python3 commentaire_seul.py 2>>python.log");
  }

  /**
  * Renvoie la valeur de sortie du script python
  */
  public function getoutput(){
    return $this->output;
  }
}
?>
