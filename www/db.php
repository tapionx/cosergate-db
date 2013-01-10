<?php

/*
mysql_fetch_all
 
Absurdly simple but utilitarian function returns a numeric array of associative arrays containing an entire result set.
*/
function mysql_fetch_all($result) {
	$all = array();
	while ($all[] = mysql_fetch_assoc($result)) {}
	return $all;
}

$db = mysql_connect('localhost','cosergate','cosergate') or die("Errore di connessione al DB");
mysql_select_db("cosergate", $db) or die("select db");

?>
