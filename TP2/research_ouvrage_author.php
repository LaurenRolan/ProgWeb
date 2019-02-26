<?php
class Ouvrage {
	var $nom;
	var $code;
	var $parution;
	var $sujet;
	var $examplaires = [];
}

class Exemplaire {
	var $nom;
	var $code;
	var $prix;
}

class PDOAuthors {
	public function __connect() { }

	public function searchByAuthor($match) {
		$conn = new PDO('pgsql:host=postgres;port=5432;dbname=livres', 'lrolan', 'l4ur3n') or die ("<br/>Could not connect to Server");
		$books = [];

		$sql = "SELECT * FROM ouvrages WHERE code='$match'";

		$resultset = $conn->prepare($sql);
		$resultset->execute();

		$books = $resultset->fetchAll();

		foreach($books as $book) {
			$book->exemplaires = searchExemplaires($book->code);	
		}
		return json_encode($books);
	}

	public function searchExemplaires($match) {
		
		$resultExemp = [];
		$sql = "SELECT * FROM exemplaire WHERE code_ouvrage='$match'";

		$resultset = $conn->prepare($sql);
		$resultset->execute();

		$exemplaires = $resultset->fetchAll();

		foreach($exemplaires as $exemp) {
			$exemplaire = new Exemplaire();
			$sql = "SELECT * FROM editeurs WHERE code='$exemp['code_editeur']'";

			$resultset = $conn->prepare($sql);
			$resultset->execute();

			$editeur = $resultset->fetch();
			$exemplaire->nom = $editeur['nom'];
			$exemplaire->code = $exemp['code'];
			$exemplaire->prix = $exemp['prix'];
			$resultExemp[] = $exemplaire;
		}
		return $resultExemp;
		
	}
}

if (isset($_POST['getAuthor'])) {
	$pdotp = new PDOAuthors();
    echo $pdotp->searchByAuthor($_POST['getAuthor']);
}
?>