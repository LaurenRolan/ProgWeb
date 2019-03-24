<?php
include 'Classes.php';

function searchByName($nom, $prenom) {
	$pdo = new PDO_TP();
	$pdo->__connect();

	$sql = "SELECT code FROM clients WHERE nom='$nom' AND prenom='$prenom'";
	
	$resultset = $pdo->conn->query($sql);
	
	$code = $resultset->fetchColumn();
	return $code;
}

if (isset($_POST['nom']) && isset($_POST['prenom'])) {
	echo searchByName($_POST['nom'], $_POST['prenom']);
}
?>