<?php
class Auteur {
	var $nom;
	var $prenom;
	var $code;
	var $naissance;
	var $code_nationalite;
}

class PDOAuthors {
	public function __connect() { }

	public function searchAuthors($match) {
		$conn = new PDO('pgsql:host=postgres;port=5432;dbname=livres', 'lrolan', 'l4ur3n') or die ("<br/>Could not connect to Server");
		$authors = [];

		$sql = "SELECT * FROM auteurs WHERE nom LIKE '%$match%' OR prenom LIKE '%$match%'";

		$resultset = $conn->prepare($sql);
		$resultset->execute();
		
		$authors = $resultset->fetchAll(PDO::FETCH_CLASS, "Auteur");

		return json_encode($authors);
	}
}

if (isset($_POST['getAuthor'])) {
	$pdotp = new PDOAuthors();
    echo $pdotp->searchAuthors($_POST['getAuthor']);
}
?>