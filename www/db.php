<?php

/*
mysql_fetch_all
 
Absurdly simple but utilitarian function returns a numeric array of associative arrays containing an entire result set.
*/
function mysql_fetch_all($result) {
	$all = array();
	while ($i = mysql_fetch_assoc($result)) { array_push($all, $i); }
	return $all;
}

function query($q){
	$q = mysql_query($q, $db) or die("Errore: '$utenti'");
	$utenti = mysql_fetch_row($nutenti)[0];

}

$db = mysql_connect('localhost','cosergate','cosergate') or die("Errore di connessione al DB");
mysql_select_db("cosergate", $db) or die("select db");

?>
