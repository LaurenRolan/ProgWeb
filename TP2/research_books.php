<?php
class Ouvrage {
	var $nom;
	var $code;
	var $parution;
	var $sujet;
}

class PDOOuvrage {
	public function __connect() { }	

	public function searchBooks($match) {
		$conn = new PDO('pgsql:host=postgres;port=5432;dbname=livres', 'lrolan', 'l4ur3n') or die ("<br/>Could not connect to Server");
		$books = [];

		$sql = "SELECT * FROM ouvrage WHERE nom LIKE '%$match%'";

		$resultset = $conn->prepare($sql);
		$resultset->execute();

		while ($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
			$book = new Ouvrage();
			$book->nom = $row['nom'];
			$book->code = $row['code'];
			$book->parution = $row['parution'];
			$book->sujet = $row['sujet'];
			$books[] = $book;
		}
		return json_encode($books);
	
	}	
	
}

if (isset($_POST['getBook'])) {
	$pdotp = new PDOOuvrage();
    echo $pdotp->searchBooks($_POST['getBook']);
}

?>