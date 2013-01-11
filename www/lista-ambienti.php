<?php
session_start();
/* logout? */
if(isset($_GET['logout'])){
	 session_unset();
	 header('Location: index.php');
}

if(isset($_SESSION['loggato'])){
	$email = $_SESSION['email'];
	echo "<p>Benvenuto ".$email.'</p>';
	require_once('db.php');
	$ambienti = query("SELECT * FROM appartenenza JOIN ambiente ON appartenenza.id_ambiente=ambiente.id_ambiente WHERE id_utente='$email'");
	while($riga = mysql_fetch_assoc($ambienti)) {
		echo '<a href="cosergate.php?ambiente='.$riga['id_ambiente'].'" >'.$riga['nome'].'</a>';
	}
	}
	
	echo "<p><a href='registra-ambiente.php'>Crea un nuovo ambiente</a></p>";
	echo '<a href="cosergate.php?logout=1">Logout</a>';
	
} else {
	echo "Non sei loggato";
}
?>
