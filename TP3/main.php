<?php
session_start();
include 'recherche_client_code.php';
if( isset( $_COOKIE['code_client'])) {
	if( !isset( $_SESSION["nom"] ) && !isset($_SESSION["prenom"])) {
		$client = new Client;
		$client = searchClientByID(substr($_COOKIE["code_client"], 0, -4)); 
		$_SESSION["nom"] = $client->nom;
		$_SESSION["prenom"] = $client->prenom;
		$_SESSION["code_client"] = substr($_COOKIE["code_client"], 0, -4);
	}
	$msg = "Bienvenue " + $_SESSION["nom"] + " " + $_SESSION["prenom"];
}
else {
	$msg = "<a href='#form' onclick='montreForm()'> Inscription </a>";
}
?>
<!DOCTYPE html>
<html>
<head> 
	<meta charset="UTF-8"> 
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css"> 
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<script>var global_code_client = <?php echo substr($_COOKIE["code_client"], 0, -4); ?></script>
	<script src="script.js"></script>
	<title> TP3 -- Vente de livres </title>
</head>
<header>
	<section>
		<?php include 'counter.php';
		echo nb();
		?> visiteurs 
	</section>
	<section><h1>Vente de livres</h1></section>
    <section> 
		<p id="msg"> <?php echo $msg; ?> </p> 
		<p id="pan"> 
			<a href="#panierNav" onlick="montrePanier()"> Consulter le panier </a>
		</p>
	</section>
</header>
<body>
	<nav>
        <div>
		<p id='mainLabel'> Recherche </p>
		<table>
			<tr> 
				<td class='label'> Auteur : </td> 
				<td> <input id="authorInput" type="text" name="author"> </td>
			</tr>
			<tr> 
				<td class='label'> Ouvrage : </td> 
				<td> <input id="workInput" type="text" name="work"> </td> 
			</tr>
		</table>
        </div>
        <br>
        <div id="form" style="display : none;">
            Nom : <input type="text" id="nomInput"> <br>
            Prenom : <input type="text" id="prenomInput"> <br>
            Adresse : <input type="text" id="adresseInput"> <br>
            CP : <input type="text" id="cpInput"> <br>
            Ville : <input type="text" id="villeInput"> <br>
            Pays : <input type="text" id="paysInput"> <br>
            <button type="button" onclick="enregistrement()"> Envoyer </button>
            <p id="message"></p>
        </div>
	</nav>
	<section id='welcome'>
		<p>Bienvenue sur le site de la bibliothèque virtuelle</p>
		<div id='panierNav' style="display : none;"> </div>
		<div id='authorNav'> </div>
		<div id='workNav'> </div>
	</section>
</body>
</html>