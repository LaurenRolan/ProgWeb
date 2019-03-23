<?php
include 'Client.php';
include 'PDO_TP.php';

function searchByName($nom, $prenom) {
	$pdo = new PDO_TP();
	$pdo->__connect();

	$sql = "SELECT code FROM clients WHERE nom='%$nom%' AND prenom='%$prenom%'";
	
	$resultset = $pdo->conn->prepare($sql);
	$resultset->execute();
	
	$code = $resultset->fetch();
	
	return $code;
}

if (isset($_POST['nom']) && isset($_POST['prenom'])) {
	echo searchByName($_POST['nom'], $_POST['prenom']);
}
?>