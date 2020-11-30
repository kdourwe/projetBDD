<?php
class AdminContestation extends view{

    function __construct(){
        $this->afficher_tete();
        $navbar= new Navbar();
        $this->afficher_contenu();
    }

    function afficher_contenu(){
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

    function message($message,$motif,$comment){
        echo <<<TXT
    <tr>
    <td>$message</td>
    <td>$motif</td>
    <td><a class="btn btn-success" href="index.php?enfant=9&n=9&com=$comment&dec=1">Accepter</a><a class="btn btn-danger" href="index.php?enfant=9&n=9&com=$comment&dec=0"> Refuser</a></td>
    </tr>
TXT;
    }
}
?>