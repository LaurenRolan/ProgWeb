<?php
include 'Classes.php';

function searchAuthors($match) {
	$pdo = new PDO_TP;
	$pdo->__connect();
	$authors = [];

	$sql = "SELECT * FROM auteurs WHERE nom LIKE '%$match%' OR prenom LIKE '%$match%'";

	$resultset = $pdo->conn->prepare($sql);
	$resultset->execute();
	
	$authors = $resultset->fetchAll(PDO::FETCH_CLASS, "Auteur");

	return json_encode($authors);
}

if (isset($_POST['getAuthor'])) {
    echo searchAuthors($_POST['getAuthor']);
}
?>