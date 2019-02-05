function findAuthor() {
	var x = document.getElementById("author").value;
	alert("Vous avez ecrit : " + x);
}

function findWork() {
	var x = document.getElementById("work").value;
	alert("Vous avez ecrit : " + x);
}

function deleteInput() {
	document.getElementById("author").value = "";
}