<?php
include 'Classes.php';

function searchBooks($match) {
	$pdo = new PDO_TP;
	$pdo->__connect();
	
	$books = [];

	$sql = "SELECT * FROM ouvrage WHERE nom LIKE '%$match%'";

	$resultset = $pdo->conn->prepare($sql);
	$resultset->execute();
	
	$books = $resultset->fetchAll(PDO::FETCH_CLASS, "Ouvrage");
	
	foreach($books as $book) {
		$book->exemplaires = array();
		$book->exemplaires = searchExemplaires($book->code);
	}

	return json_encode($books);

}
	
function searchExemplaires($match) {
	$pdo = new PDO_TP;
	$pdo->__connect();
	
	$resultExemp = [];
	$sql = "SELECT * FROM exemplaire WHERE code_ouvrage='$match'";

	$resultset = $pdo->conn->prepare($sql);
	$resultset->execute();

	$exemplaires = $resultset->fetchAll();

	foreach($exemplaires as $exemp) {
		$exemplaire = new Exemplaire();
		$code = $exemp['code_editeur'];
		$sql = "SELECT * FROM editeurs WHERE code='$code'";

		$resultset = $pdo->conn->prepare($sql);
		$resultset->execute();

		$editeur = $resultset->fetch();
		$exemplaire->nom = $editeur['nom'];
		$exemplaire->code = $exemp['code'];
		$exemplaire->prix = $exemp['prix'];
		$resultExemp[] = $exemplaire;
	}
	return $resultExemp;
}

if (isset($_POST['getBook'])) {
    echo searchBooks($_POST['getBook']);
}
?>