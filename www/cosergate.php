<?php

session_start();
require_once('db.php');

if(!isset($_SESSION['loggato']) || (!isset($_GET['ambiente']))) {
	header('Location: index.php');
	die('1');
}

$query = "SELECT * FROM ambiente WHERE id_ambiente='{$_GET['ambiente']}';";
$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
if(mysql_num_rows($esiste) == 0){
	die('2');
}

$query = "SELECT * FROM appartenenza WHERE id_ambiente='{$_GET['ambiente']}' AND id_utente='{$_SESSION['email']}';";
$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
if(mysql_num_rows($esiste) == 0){
	die('3');
}
?>

<p>Il resoconto</p>
<?php
$nutenti = "SELECT count() FROM appartenenza WHERE id_ambiente={$_GET['ambiente']};";
?>
<p>La lista</p>

