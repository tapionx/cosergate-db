<!DOCTYPE html>
<html>
	<head>
		<title>Cosergate</title>
	</head>
	<body>
<?php 
session_start();
require_once('db.php');

if(!isset($_SESSION['loggato'])){
		die("Non Loggato.");
		echo '<a href="index.php">Fai il login</a>';
}

if(!isset($_GET['ambiente'])){
		die("Nessun ambiente selezionato.");
		echo '<a href="lista-ambienti.php">Seleziona un ambiente.</a>';
}

/* Controllo se esiste l'ambiente */

$query = "SELECT * FROM ambiente WHERE id_ambiente={$_GET['ambiente']}";
$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
if(mysql_num_rows($esiste) == 0){
	die('2');
}

if(isset($_POST['rimuovi'])){
	
		$query = "DELETE FROM appartenenza WHERE id_utente='".$_SESSION['email']."' AND id_ambiente=".$_GET['ambiente']." AND saldo=0";
		$rimozione = mysql_query($query, $db) or die('Errore nella DELETE');

		if( mysql_affected_rows() == 1){ /* controllo se l'eliminazione è andata a buon fine*/
			echo "Ti sei rimosso con successo.<br>";
			echo '<a href="lista-ambienti.php">Torna alla lista ambienti</a>';
			exit();
		}else{
			echo "Devi aver saldato tutti i tuoi debiti prima di lasciare un ambiente.";
		}
}

 /* controllo se l'utente appartiene all'ambiente */
 
$query = "SELECT * FROM appartenenza WHERE id_ambiente={$_GET['ambiente']} AND id_utente='{$_SESSION['email']}'";
$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
if(mysql_num_rows($esiste) == 0){
	die('3');
}

?>

<form method="post" action="">
	<p>Questa operazione non può essere annullata, una volta uscito da un ambiente dovrai essere re-invitato.</p>
	<p>Per uscire dall'ambiente devi prima aver saldato tutti i debiti e aver ricevuto tutti i crediti.</p>
	<input type="submit" value="Rimuoviti" name="rimuovi">
</form>

<?php 
echo '<a href="cosergate.php?ambiente='.$_GET['ambiente'].'">Torna indietro</a>';
?>
