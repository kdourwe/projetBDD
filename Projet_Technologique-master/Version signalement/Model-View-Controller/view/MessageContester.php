<?php
class MessageContester extends view{

    function __construct(){
        $this->afficher_tete();
        $this->afficher_contenu();
    }

    function afficher_contenu(){
        $this->backtomenu();
        $this->tab_connexion();
    }

    function tab_connexion(){
        echo <<<TXT
        <table>
         <tr>
          <th>Message modéré</th>
          <th>Motif de l'avertissement</th>
          <th>Contestation</th>
TXT;
    }

    function fin_tab(){
         echo <<<TXT
        </table>
TXT;
  }

  function backtomenu(){
    echo <<<TXT
    <a href=index.php?parent=5> << Retour</a>
TXT;
  }

  function message($message,$motif,$kid){
    echo <<<TXT
    <tr>
    <td>$message</td>
    <td>$motif</td>
    <td><a class="btn btn-danger" href="index.php?parent=10&kid=$kid&cont=1">contester</a><a class="btn btn-success" href="index.php?parent=10&kid=$kid&cont=0"> accepter</a></td>
    </tr>
TXT;
  }

  function nointervention($message,$motif){
      echo <<<TXT
    <tr>
    <td>$message</td>
    <td>$motif</td>
    <td>Contactez l'administrateur du site si vous souhaitez contester cette avertissement</td>
    </tr>
TXT;
  }

  function demandeencour($message,$motif){
       echo <<<TXT
    <tr>
    <td>$message</td>
    <td>$motif</td>
    <td>Votre demande est en cours de traitement</td>
    </tr>
TXT;
  }


}
?>
