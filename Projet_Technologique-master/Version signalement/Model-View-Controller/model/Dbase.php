<?php
/**
* Permet de se connecter à la base de données
*/
abstract class Dbase extends Model{
	protected $host;
	protected $user;
	protected $pswd;
	protected $db_name;
	protected $pdo;
	
	/**
	* Enregistre les paramètres de connexion dans les attributs
	* Lance la fonction connect()
	*/
	function __construct (){
		$this->host = "localhost";
		$this->user = "etudiant";
		$this->pswd = "A123456*";
		$this->db_name = "dbetu";
		$this->connect();
	}
	
	/**
	* Crée la connection à la base de données
	*/
	public function connect(){
		//$this->db=new PDO('mysql: host='.$this->host.'; dbname='.$this->dbname,$this->user,$this->pswd, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		try {
			$this->pdo = new PDO(	"pgsql:host={$this->host};
							dbname={$this->db_name}",
							"{$this->user}",
							"{$this->pswd}");

			// afficher les messages d'erreurs pour trouver les erreurs
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

			// jeu de caractères : UTF-8
			$this->pdo->query("SET NAMES utf8");
			$this->pdo->query("SET CHARACTER SET utf8");

		}
		catch (PDOException $exception) {
			echo "Connexion échouée : " . $exception->getMessage();
		}

	}

	/**
	* Fonction abstraite pour la requête
	*/
	public abstract function requete();


}
?>
