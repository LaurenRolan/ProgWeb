<?php
include 'Classes.php';

function getPanier($code_client) {
		$pdo = new PDO_TP;
		$pdo->__connect();
		
		$code_client = (int) $code_client;
		
		$items = [];
		
		$sql = "SELECT * FROM panier WHERE code_client=$code_client";

		$resultset = $pdo->conn->prepare($sql);
		$resultset->execute();
		
		$items = $resultset->fetchAll();
		
		foreach($items as $item) {
			$book->exemplaires = searchExemplaires($book->code);
		}

		return json_encode($items);
}
	
if (isset($_GET['client'])) {
	echo getPanier($_GET['client']);
}
?>