<?php
class PDOClients {
	var $conn;
	
	public function __connect() {
		$this->conn = new PDO('pgsql:host=postgres;port=5432;dbname=livres', 'lrolan', 'l4ur3n') or die ("<br/>Could not connect to Server");
	}

	public function insertClient($match) {

		$sql = "SELECT inscript('$nom', '$prenom', '$adresse', '$cp', '$ville', '$ville', '$pays');";
		$resultset = $conn->fConn>query($sql);
		$code_client = $resultset->fetch()[0];

		if($code_client == 0) 
			echo "no";
		else
			echo code_client;
	}
}

if (isset($_POST['nom'], $_POST['prenom'])) { //Completer
	$pdotp = new PDOClients();
	$pdotp->__connect();
    echo $pdotp->insertClient($_POST['nom'], $_POST['prenom']);
}

?>