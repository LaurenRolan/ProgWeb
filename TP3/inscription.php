<?php
class PDOClients {
	var $conn;
	
	public function __connect() {
		$this->conn = new PDO('pgsql:host=postgres;port=5432;dbname=livres', 'lrolan', 'l4ur3n') or die ("<br/>Could not connect to Server");
	}

	public function insertClient($nom, $prenom, $adresse, $cp, $ville, $pays ) {
		$sql = "SELECT inscription('$nom', '$prenom', '$adresse', '$cp', '$ville', '$pays');";
        echo $sql;
		$resultset = $this->conn->query($sql);
		$code_client = $resultset->fetch()[0];

		if($code_client == 0) 
			return "no";
		else
			return $code_client;
	}
}

if (isset($_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['pays'])) { //Completer
	$pdotp = new PDOClients();
	$pdotp->__connect();
    echo $pdotp->insertClient($_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['pays']);
}

?>