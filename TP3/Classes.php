<?php
class Ouvrage {
	var $nom;
	var $code;
	var $parution;
	var $sujet;
	var $exemplaires = [];
}

class Exemplaire {
	var $nom;
	var $code;
	var $prix;
}

class Client {
	var $nom;
	var $prenom;
}

class Auteur {
	var $nom;
	var $prenom;
	var $code;
	var $naissance;
	var $code_nationalite;
}

class PDO_TP {
	public $conn;
	public function __connect() {
		$this->conn = new PDO('pgsql:host=postgres;port=5432;dbname=livres', 'lrolan', 'l4ur3n') or die ("<br/>Could not connect to Server");
	}
}
?>