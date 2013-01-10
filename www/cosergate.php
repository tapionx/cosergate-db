<?php

session_start();

if(!isset($_SESSION['loggato']) || (!isset($_GET['ambiente'])))
	header('Location: index.php');
	die();

$query = "SELECT * FROM ambiente WHERE id_ambiente='${$_GET['ambiente']}';";
$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
if(mysql_num_rows($esiste) == 0){
	die();
}

$query = "SELECT * FROM appartenenza WHERE id_ambiente='${$_GET['ambiente']}' AND id_utente=${_SESSION['email']};";
$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
if(mysql_num_rows($esiste) == 0){
	die();
}




?>
