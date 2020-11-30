<?php
class ListeConnexion extends View{
  private $idenfant;

  function __construct(){
    $this->afficher_tete();
    $this->afficher_contenu();
  }

  function afficher_contenu(){
    $this->backtomenu();
    $this->tab_connexion();
  }

  function backtomenu(){
    echo <<<TXT
    <a href=index.php?parent=5> << Retour</a>
TXT;
  }

  function tab_connexion(){
    echo <<<TXT
    <table>
      <tr>
        <th>Jour</th>
        <th>Heure</th>
      </tr>
TXT;
  }

  function contenu($day,$time){
    echo <<<TXT
      <tr>
        <td>$day</td>
        <td>$time</td>
      </tr>
TXT;
  }
  function warning_contenu($day,$time){
    echo <<<TXT
    <tr>
      <td class="table-danger">$day</td>
      <td class="table-danger">$time</td>
    </tr>
TXT;
  }

  function fin_tab(){
    echo <<<TXT
    </table>
TXT;
  }


}
?>
