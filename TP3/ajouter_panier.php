<?php
include 'Classes.php';

function insertIntoPanier($code_exemplaire, $code_client) {
		$pdo = new PDO_TP;
		$pdo->__connect();
		
		$code_client = (int) $code_client;
		$code_exemplaire = (int) $code_exemplaire;
				
		$sql = "INSERT INTO panier (code_client, code_exemplaire, quantite) VALUES ($code_client, $code_exemplaire, 1)";

		if($pdo->conn->exec($sql) == false)
			echo "Error";
		else
			echo "Success";
}
	
if (isset($_POST['exemp']) && isset($_POST['client'])) {
	echo insertIntoPanier($_POST['exemp'], $_POST['client']);
}
?>