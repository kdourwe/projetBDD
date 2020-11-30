<?php
/**
* Permet d'ajouter un commentaire à BDD_insultes.txt
*/
class AddBdd extends Model{
  /**
  Inscrit dans le fichier "BDD_insultes.txt" le commentaire entré en paramètres
  */
  public function __construct($com){
    file_put_contents("BDD_insultes.txt", $com."\n", FILE_APPEND);
  }
}
?>
