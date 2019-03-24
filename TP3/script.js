function affiche_auteurs(data) {
	$('#authorNav').text("");
	$('#authorNav').append("<ol>");
	jQuery.each(data, function(index, item) {
		$('#authorNav').append("<li class='author' id=" + item.code + "><a href=\"#workNav\" onclick=\"recherche_ouvrages_auteur("+ item.code +")\">" + item.prenom + " " + item.nom + "</a></li>");
	});
	$('#authorNav').append("</ol>");	

}

function affiche_ouvrages(data) {
	$('#workNav').text("");
	$('#workNav').append("<ol>");
	jQuery.each(data, function(index, item) {
		$('#workNav').append("<li class='work'>" + item.nom + "<ul id=" + item.code +"></ul>" + "</li>");
		affiche_exemplaires(item.exemplaires, item.code);
	});
	$('#workNav').append("</ol>");	

}

function affiche_panier(data) {
	$('#panierNav').text("");
	$('#panierNav').append("<table>");
	var header = "<tr><th>Titre</th><th>Editeur</th>" +
				"<th>Prix</th><th>Quantite</th>";
	$('#panierNav').append(header);
	jQuery.each(data, function(index, item) {
		var line = "<tr> <td>" + item.titre + 
			"</td><td>" + item.editeur +"</td><td>" +
			item.prix + "</td><td>" + item.quantite + 
			"</td></tr>";
		$('#panierNav').append(line);
	});
	$('#panierNav').append("</table>");	

}

function affiche_exemplaires(exemplaires, code) {
	exemplaires.forEach(function(item) {
		var line = "<li class='exemplaire'>" + item.nom + 
					", " + item.prix + " euros [<a href='javascript:ajouter_panier(" +
					item.code + ");'> ajouter au panier </a>] </li>";
		$('#' + code).append(line);
	});
}

function recherche_ouvrages_auteur(code) {
	var codeString = "" + code;
	$.ajax({
        type: 'POST',
        url: 'recherche_ouvrage_auteur.php',
        data: {'getAuthor' : codeString},
        dataType: 'json',
        success: function(data) { affiche_ouvrages(data); }
    });
}

function montreForm() {
	var form = document.getElementById("form");
	form.style.display = "block";
}

function fermePanier() {
	document.getElementById("authorNav").style.display = "block";
	document.getElementById("workNav").style.display = "block"; 
	document.getElementById("panierNav").style.display = "none";
}

function montrePanier() {
	document.getElementById("authorNav").style.display = "none";
	document.getElementById("workNav").style.display = "none"; 
	var panier = document.getElementById("panierNav");
	panier.style.display = "block";
	$.ajax({
        type: 'POST',
        url: 'panier_info.php',
        data: {'client' : global_code_client},
        dataType: 'json',
        success: function(data) { 
			alert("Under construction.");
			//affiche_panier(data); 
		}
    });
	
}

function ajouter_panier(code_exemplaire) {
	$.ajax({
        type: 'POST',
        url: 'ajouter_panier.php',
        data: {'exemp' : code_exemplaire,
			   'client' : global_code_client}
    });
	alert("L'article a été ajouté au panier");
}

function vider_panier(code_exemplaire) {
	$.ajax({
        type: 'POST',
        url: 'vider_panier.php',
        data: {'client' : global_code_client}
    });
	alert("Le panier a été vidé.");
}

function enregistrement() {
	var nom = document.getElementById("nomInput").value;
    var prenom = document.getElementById("prenomInput").value;
    var adresse = document.getElementById("adresseInput").value;
    var cp = document.getElementById("cpInput").value;
    var ville = document.getElementById("villeInput").value;
    var pays = document.getElementById("paysInput").value;

    if(nom == "" || prenom == "" || adresse == "" || cp == "" || ville == "" || pays == "" )
    {
        document.getElementById("message").innerText = "Il faut remplir tous les champs";
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'inscription.php',
        data: {'nom' : nom,
				'prenom' : prenom,
				'adresse' : adresse,
				'cp' : cp,
				'ville': ville,
				'pays' : pays},
        dataType: 'text',
        success: function(data) {
			if(data != "no") {
				setCookie(data);
			}
			else {
				getClientCode(nom, prenom);
			}
		}
    });
	showName(nom, prenom);
}

function showName(nom, prenom) {
	var par = document.getElementById("msg");
	msg.innerText = "Bienvenue " + nom + " " + prenom;
}

function getClientCode(nom, prenom) {
	$.ajax({
        type: 'POST',
        url: 'recherche_client_nom.php',
        data: {'nom' : nom,
				'prenom' : prenom},
        dataType: 'text',
        success: function(data) {
			setCookie(data);
		}
	});
}

function setCookie(code_client) {
	var form = document.getElementById("form");
	form.style.display = 'none';
	var d = new Date();
	d.setTime(d.getTime() + (60*60*1000));
	var expires = d.toUTCString();
	document.cookie = "code_client=" + code_client + "2050;expires=" + expires;
}

$(function() {
	$('#authorInput').keyup(function() {
		$('#workInput').val("");
		$('#workNav').text("");
		$.ajax({
                type: 'POST',
                url: 'recherche_auteur.php',
                data: {'getAuthor' : $('#authorInput').val()},
                dataType: 'json',
                success: function(data) { affiche_auteurs(data); }
            });
	});
});

$(function() {
	$('#workInput').keyup(function() {
		$('#authorInput').val("");
		$('#authorNav').text("");
		$.ajax({
                type: 'POST',
                url: 'recherche_ouvrages_titre.php',
                data: {'getBook' : $('#workInput').val()},
                dataType: 'json',
                success: function(data) { affiche_ouvrages(data); }
            });
	});
});