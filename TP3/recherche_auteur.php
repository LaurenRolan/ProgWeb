<?php
include 'Classes.php';

class PDOAuthors {
	var $conn;
	
	public function __connect() {
		$this->conn = new PDO('pgsql:host=postgres;port=5432;dbname=livres', 'lrolan', 'l4ur3n') or die ("<br/>Could not connect to Server");
	}

	public function searchAuthors($match) {
		$authors = [];

		$sql = "SELECT * FROM auteurs WHERE nom LIKE '%$match%' OR prenom LIKE '%$match%'";

		$resultset = $this->conn->prepare($sql);
		$resultset->execute();
		
		$authors = $resultset->fetchAll(PDO::FETCH_CLASS, "Auteur");

		return json_encode($authors);
	}
}

if (isset($_POST['getAuthor'])) {
	$pdotp = new PDOAuthors();
	$pdotp->__connect();
    echo $pdotp->searchAuthors($_POST['getAuthor']);
}
?>