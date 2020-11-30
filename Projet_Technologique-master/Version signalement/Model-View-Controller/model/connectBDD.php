<?php
class Check extends Model{

public static $instance = null;

private $pdo;

public static function Get()
{
	if(self::$instance == null)
		self::$instance = new BDD();

	return self::$instance;
}

private function __construct()
{

	$servername = "ServerMaison";
	$dbname = "dbetu";
	$username = "etudiant";
	$password = "A123456*";

	$dsn = "pgsql:host=$host;port=5432;db_name=$dbname;user=$username;pswd=$password";

	try {
			$conn = new PDO($dsn);
			// set the PDO error mode to exception
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
	catch(PDOException $e)
			{
			echo "Connection failed: " . $e->getMessage();
			}

}

public function GetPDO() {
	return $this->pdo;
}
?>
