<?php
class Ouvrage {
	var $nom;
	var $code;
	var $parution;
	var $sujet;
}

class PDOAuthorSearch {
	public function __connect() { }

	public function searchByAuthor($match) {
		$conn = new PDO('pgsql:host=postgres;port=5432;dbname=livres', 'lrolan', 'l4ur3n') or die ("<br/>Could not connect to Server");
		$books = [];

		$sql = "SELECT * FROM ecrit_par WHERE code_auteur=$match"; 
		//Utiliser ecrit_par comme middleman

		$resultset = $conn->prepare($sql);
		$resultset->execute();

		$codeLivre = $resultset->fetch(PDO::FETCH_ASSOC)['code_ouvrage'];

		$sql = "SELECT * FROM ouvrage WHERE code=$codeLivre"; 
		//Utiliser ecrit_par comme middleman

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

if (isset($_POST['getAuthor'])) {
	$pdotp = new PDOAuthorSearch();
    echo $pdotp->searchByAuthor($_POST['getAuthor']);
}

?>