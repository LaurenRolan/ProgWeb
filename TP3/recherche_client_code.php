<?php
include 'Classes.php';

function searchClientByID($match) {
		$client = new Client;
		$pdo = new PDO_TP;
		$pdo->__connect();
		
		$sql = "SELECT * FROM clients WHERE code='$match'";

		$resultset = $pdo->conn->query($sql);
		
		$client->nom = $resultset->fetch()['nom'];
		$client->prenom = $resultset->fetch()['prenom'];

		return $client;
	}
?>