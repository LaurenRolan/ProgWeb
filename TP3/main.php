<!DOCTYPE html>
<html>
<head> 
	<meta charset="UTF-8"> 
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css"> 
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="script.js"></script> 

	<title> TP2 -- Vente de livres </title> 
</head>
<header>
	<section>
		<?php include 'counter.php';
		echo nb();
		?> visiteurs 
	</section>
	<section><h1>Vente de livres</h1></section>
	<section> Bienvenu NOM Prenon <br/> Quitter </section>
</header>
<body>
	<nav>
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
	</nav>
	<section id='welcome'>
		<p>Bienvenu sur le site de la bibliothèque virtuelle</p>
		<div id='authorNav'> </div>
		<div id='workNav'> </div>
	</section>
</body>
</html>