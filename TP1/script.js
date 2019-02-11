$(function() {
	$('#authorInput').keyup(function() {
		$.ajax({
                type: 'POST',
                url: 'requete.php',
                data: {'getAuthor' : $('#authorInput').val()},
                dataType: 'json',
                success: function(data) {
                	$('#authorNav').text("");
                	$('#authorNav').append("<table>");
                	jQuery.each(data, function(index, item) {
            			$('#authorNav').append("<tr><td>" + item.prenom + " " + item.nom + "</td></tr>");            			
       	 			});
                }
            });
	});
});


$(function() {
	$('#workInput').keyup(function() {
		$('#workNav').text($('#workInput').val())
	});
});

$(function() {
    $('input').focusout(function() {
        $('input').val('');
		$('#workNav').text('Livres ici !');
		$('#authorNav').text('Auteurs ici !');
    });
});