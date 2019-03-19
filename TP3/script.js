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
		console.log(item.exemplaires);
		affiche_exemplaires(item.exemplaires, item.code);
	});
	$('#workNav').append("</ol>");	

}

function affiche_exemplaires(exemplaires, code) {
	exemplaires.forEach(function(item) {
		console.log(code + " " + item.nom);
		$('#' + code).append("<li class='exemplaire'>" + item.nom + ", " + item.prix + " euros</li>");
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
            var form = document.getElementById("form");
            form.style.display = 'none';
            var d = new Date();
            d.setTime(d.getTime() + (60*60*1000));
            var expires = d.toUTCString();
            document.cookie = "username=" + nom + prenom + ";expires=" + expires;
        }
    });
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