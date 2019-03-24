<?php
include 'Classes.php';

function searchByAuthor($match) {
	$pdo = new PDO_TP;
	$pdo->__connect();
	
	$books = [];

	$sql = "SELECT * FROM ecrit_par WHERE code_auteur=$match"; 
	
	$resultset = $pdo->conn->prepare($sql);
	$resultset->execute();

	$codeLivre = $resultset->fetch(PDO::FETCH_ASSOC)['code_ouvrage'];

	$sql = "SELECT * FROM ouvrage WHERE code=$codeLivre"; 
	
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



if (isset($_POST['getAuthor'])) {
	echo searchByAuthor($_POST['getAuthor']);
}

?>