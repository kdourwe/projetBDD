<?php
class Navbar extends View{

	function __construct(){
		    $this->afficher_contenu();
	}

	function afficher_contenu(){
		echo <<<TXT
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="index.php?enfant=1&time">Accueil</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  <li class="nav-item">
				<a class="nav-link" href="index.php?enfant=2&">Forum</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="index.php?enfant=6&time">Articles</a>
			  </li>
TXT;
		if($_SESSION['admin']!=0){
			echo <<<TXT
			<li class="nav-item">
				<a class="nav-link" href="index.php?enfant=9&n=1">Membres</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?enfant=9&n=2">Commentaires signalés</a>
			</li>

TXT;
			if($_SESSION['admin']==2){
				echo <<<TXT
				<li class="nav-item">
					<a class="nav-link" href="index.php?enfant=9&n=7">Modérateurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?enfant=9&n=9">Modétations contestés</a>
				</li>
TXT;
			}

			echo <<<TXT
			</div>
		</nav>
TXT;
		}
    else{
			$t=date("H:i:s",$_SESSION['timer_max']);
      echo <<<TXT
            </ul>
            <li class="navbar-text">
             Vous serez automatiquement déconnecté à $t.
            </li>
		  </div>
		</nav>
TXT;
		}
	}
}

?>
