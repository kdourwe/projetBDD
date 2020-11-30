<?php
class ListActiviteMod extends view{

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
                 <th>Message</th>
                 <th>Date de modération</th>
                 <th>Décision</th>
                 <th>Motif</th>
               </tr>
TXT;
    }

    function finTable(){
        echo <<<TXT
        </table>
TXT;
    }

    function getcomment($message,$date,$decision,$motif){
        echo <<<TXT
             <tr>
               <td>$message</td>
               <td>$date</td>
               <td>$decision</td>
               <td>$motif</td>
            </tr>
TXT;
    }
}
?>