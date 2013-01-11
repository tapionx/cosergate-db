<?php 
session_start();

if(!isset($_SESSION['loggato'])){
		die("Non Loggato.");
		echo '<a href="index.php">Fai il login</a>';
}

if(!isset($_GET['ambiente'])){
		die("Nessun ambiente selezionato.");
		echo '<a href="lista-ambienti.php">Seleziona un ambiente.</a>';
}
?>
