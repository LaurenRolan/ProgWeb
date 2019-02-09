$(function() {
	$('#authorInput').keyup(function() {
		$('#authorNav').text($('#authorInput').val())
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