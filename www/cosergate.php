<?php

session_start();
require_once('db.php');

if(!isset($_SESSION['loggato']) || (!isset($_GET['ambiente']))) {
	header('Location: index.php');
	die('1');
}

$query = "SELECT * FROM ambiente WHERE id_ambiente={$_GET['ambiente']}";
$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
if(mysql_num_rows($esiste) == 0){
	die('2');
}

$query = "SELECT * FROM appartenenza WHERE id_ambiente={$_GET['ambiente']} AND id_utente='{$_SESSION['email']}'";
$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
if(mysql_num_rows($esiste) == 0){
	die('3');
}
?>

<p>Il resoconto</p>
<?php
$query = "SELECT count(id_utente) AS nutenti FROM appartenenza WHERE id_ambiente={$_GET['ambiente']};";
$nutenti = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
$nutenti = mysql_fetch_assoc($nutenti)['nutenti'];

$query = "SELECT username, totale FROM appartenenza JOIN utente ON appartenenza.id_utente=utente.email WHERE id_ambiente={$_GET['ambiente']};";
$utenti = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
$utenti = mysql_fetch_all($utenti);

$query = "SELECT count(id_utente) AS nutenti FROM appartenenza WHERE id_ambiente={$_GET['ambiente']};";
$nutenti = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
$nutenti = mysql_fetch_assoc($nutenti)['nutenti'];

echo "<table border=1><tr>";
foreach($utenti as $utente) {
	echo "<td>{$utente['username']}</td>";
}

echo '<tr>';
foreach($utenti as $utente) {
	echo "<td>{$utente['totale']}</td>";
}
echo '</tr>';

echo "</tr></table>";

$query = "SELECT * FROM spesa WHERE ambiente={$_GET['ambiente']}";
$spese = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
$spese = mysql_fetch_all($spese);

echo "<table border=1>";
foreach($spese as $spesa){
	echo "<tr>";
	foreach($spesa as $campo){
		echo '<td>'.$campo.'</td>';
	}
	echo "</tr>";
}
echo "</table>";	


?>
<p>La lista</p>

