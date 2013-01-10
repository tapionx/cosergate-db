<?php
session_start();
if(isset($_SESSION['loggato'])){
	$email = $_SESSION['email'];
	echo "<p>Benvenuto ".$email.'</p>';
	require_once('db.php');
	$query = "SELECT * FROM appartenenza JOIN ambiente ON appartenenza.id_ambiente=ambiente.id_ambiente WHERE id_utente='$email'";
	$ambienti = mysql_query($query, $db) or die('Errore nella SELECT');
	
	if(mysql_num_rows($ambienti) == 0){
		echo "<p>Non appartieni a nessun ambiente</p>";
	} else {
		while($riga = mysql_fetch_row($ambienti)) {
			echo $riga['nome'];
		}
	}
	
	echo "<p><a href='registra-ambiente.php'>Crea un nuovo ambiente</a></p>";
	
} else {
	echo "Non sei loggato";
}
?>
