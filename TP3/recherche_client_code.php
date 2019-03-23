<?php
include 'Client.php';
include 'PDO_TP.php';

function searchClientByID($match) {
		$client = new Client;
		$pdo = new PDO_TP;
		$pdo->__connect();
		
		$sql = "SELECT * FROM clients WHERE code is '%$match%'";

		$resultset = $pdo->conn->prepare($sql);
		$resultset->execute();
		
		$client->nom = $resultset->fetch(PDO::FETCH_ASSOC)['nom'];
		$client->prenom = $resultset->fetch(PDO::FETCH_ASSOC)['prenom'];

		return $client;
	}
?>