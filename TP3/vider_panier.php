<?php
include 'Classes.php';

function viderPanier($code_client) {
		$pdo = new PDO_TP;
		$pdo->__connect();
		
		$code_client = (int) $code_client;		
		
		$sql = "DELETE FROM panier WHERE code_client=$code_client";

		if($pdo->conn->exec($sql) == false)
			echo "Error";
		else
			echo "Success";
}
	
if (isset($_POST['client'])) {
	echo viderPanier($_POST['client']);
}
?>