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


 echo '<a href="aggiungi-utente.php?ambiente='.$_GET['ambiente'].'">Aggiungi Utente</a><br/>';
 echo '<a href="cosergate.php?logout=1">Logout</a>';
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
?>

<p>La lista</p>

<form method="get" action="registra-spesa.php">
<input type="hidden" name="ambiente" value="<?php echo $_GET['ambiente']; ?>"/>
<input type="submit" value="Inserisci una spesa" />
</form>

<?php
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
	
	$prodotti = "SELECT * FROM prodotto WHERE spesa={$spesa['id_spesa']};";
	$prodotti = mysql_query($prodotti, $db) or die("Errore nella SELECT: '$prodotti'");
	$prodotti = mysql_fetch_all($prodotti);
	foreach($prodotti as $prodotto){
	echo "<tr>";
		foreach($prodotto as $campo){
			echo '<td>'.$campo.'</td>';
		}
	echo "</tr>";
	}
	
}
echo "</table>";	


?>


