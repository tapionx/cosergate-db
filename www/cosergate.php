<?php

session_start();
require_once('db.php');

/* logout? */
if(isset($_GET['logout'])){
	 session_unset();
	 header('Location: index.php');
}

/* Utente loggato? */

if(!isset($_SESSION['loggato']) || (!isset($_GET['ambiente']))) {
	header('Location: index.php');
	die('1');
}

/* Controllo se esiste l'ambiente */

$query = "SELECT * FROM ambiente WHERE id_ambiente={$_GET['ambiente']}";
$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
if(mysql_num_rows($esiste) == 0){
	die('2');
}
 /* controllo se l'utente appartiene all'ambiente */
 
$query = "SELECT * FROM appartenenza WHERE id_ambiente={$_GET['ambiente']} AND id_utente='{$_SESSION['email']}'";
$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
if(mysql_num_rows($esiste) == 0){
	die('3');
}


 echo '<a href="aggiungi-utente.php?ambiente='.$_GET['ambiente'].'">Aggiungi Utente</a><br/>';
 echo '<a href="rimuovi-utente.php?ambiente='.$_GET['ambiente'].'">Rimuoviti dall\'ambiente</a><br/>';
 echo '<a href="cosergate.php?logout=1">Logout</a>';
?>
<p>Il resoconto</p>
<?php
$query = "SELECT count(id_utente) AS nutenti FROM appartenenza WHERE id_ambiente={$_GET['ambiente']};";
$nutenti = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
$nutenti = mysql_fetch_assoc($nutenti)['nutenti'];

$query = "SELECT username, saldo FROM appartenenza JOIN utente ON appartenenza.id_utente=utente.id_utente WHERE id_ambiente={$_GET['ambiente']};";
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
	echo "<td>{$utente['saldo']}</td>";
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
$spese = query("SELECT * FROM spesa WHERE id_ambiente={$_GET['ambiente']}");

echo "<table border=1>";
foreach($spese as $spesa){
	echo "<tr>";
	foreach($spesa as $campo){
		echo '<td>'.$campo.'</td>';
	}
	echo "</tr>";
	
	$prodotti = query("SELECT * FROM prodotto WHERE id_spesa={$spesa['id_spesa']};");
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


