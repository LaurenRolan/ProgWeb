function affiche_auteurs(data) {
	$('#authorNav').text("");
	$('#authorNav').append("<ol>");
	jQuery.each(data, function(index, item) {
		$('#authorNav').append("<li><a href=\"#workNav\" onclick=\"recherche_ouvrages_auteur("+ item.code +")\">" + item.prenom + " " + item.nom + "</a></li>");
	});
	$('#authorNav').append("</ol>");	

}

function affiche_ouvrages(data) {
	$('#workNav').text("");
	$('#workNav').append("<ol>");
	jQuery.each(data, function(index, item) {
		$('#workNav').append("<li>" + item.nom + "<li>");
	});
	$('#workNav').append("</ol>");	

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


$(function() {
	$('#authorInput').keyup(function() {
		$('#workInput').val("");
		$('#workNav').text('Livres ici !');
		$.ajax({
                type: 'POST',
                url: 'research_author.php',
                data: {'getAuthor' : $('#authorInput').val()},
                dataType: 'json',
                success: function(data) { affiche_auteurs(data); }
            });
	});
});

$(function() {
	$('#workInput').keyup(function() {
		$('#authorInput').val("");
		$('#authorNav').text('Auteurs ici !');
		$.ajax({
                type: 'POST',
                url: 'research_books.php',
                data: {'getBook' : $('#workInput').val()},
                dataType: 'json',
                success: function(data) { affiche_ouvrages(data); }
            });
	});
});