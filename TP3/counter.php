<?php

function nb()
{
	if (file_exists("counter.txt")){
		$file = fopen("counter.txt","r");
		$counter = (int) fread($file, filesize("counter.txt"));
		fclose($file);
	}else{
	   $counter = 1;
	}

	if(!isset($_COOKIE["visite"])) {
		$counter++;
		setcookie("visite", "true", time() + 3600);

		$file = fopen("counter.txt","w");
		fwrite($file, $counter);
		fclose($file);
	}
	return $counter;
}

?>