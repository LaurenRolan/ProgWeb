<!DOCTYPE html>
<html>
<head> 
	<meta charset="UTF-8"> 
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css"> 
	<title> TP2 -- Vente de livres </title> 
	<script src="script.js"></script> 
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
		Recherche :
		<ul>
			<li> Auteur : <input id="authorInput" type="text" name="author"> </li>
			<li> Ouvrage : <input id="workInput" type="text" name="work"> </li>
		</ul>
	</nav>
	<section id='welcome'>
		<p>Bienvenu sur le site de la bibliothèque virtuelle</p>
		<div id='authorNav'> </div>
		<div id='workNav'> </div>
	</section>
</body>
</html>