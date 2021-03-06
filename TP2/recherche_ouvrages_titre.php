<?php
class Ouvrage {
	var $nom;
	var $code;
	var $parution;
	var $sujet;
	var $exemplaires = [];
}

class Exemplaire {
	var $nom;
	var $code;
	var $prix;
}

class PDOOuvrage {
	var $conn;
	
	public function __connect() {
		$this->conn = new PDO('pgsql:host=postgres;port=5432;dbname=livres', 'lrolan', 'l4ur3n') or die ("<br/>Could not connect to Server");
	}

	public function searchBooks($match) {
		$books = [];

		$sql = "SELECT * FROM ouvrage WHERE nom LIKE '%$match%'";

		$resultset = $this->conn->prepare($sql);
		$resultset->execute();
		
		$books = $resultset->fetchAll(PDO::FETCH_CLASS, "Ouvrage");
		
		foreach($books as $book) {
			$book->exemplaires = array();
			$book->exemplaires = $this->searchExemplaires($book->code);
		}

		return json_encode($books);
	
	}
	
	public function searchExemplaires($match) {
		
		$resultExemp = [];
		$sql = "SELECT * FROM exemplaire WHERE code_ouvrage='$match'";

		$resultset = $this->conn->prepare($sql);
		$resultset->execute();

		$exemplaires = $resultset->fetchAll();

		foreach($exemplaires as $exemp) {
			$exemplaire = new Exemplaire();
			$code = $exemp['code_editeur'];
			$sql = "SELECT * FROM editeurs WHERE code='$code'";

			$resultset = $this->conn->prepare($sql);
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


if (isset($_POST['getBook'])) {
	$pdotp = new PDOOuvrage();
	$pdotp->__connect();
    echo $pdotp->searchBooks($_POST['getBook']);
}


?>