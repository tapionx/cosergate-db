<?php
session_start();
/* logout? */
if(isset($_GET['logout'])){
	 session_unset();
	 header('Location: index.php');
	 die();
}

if(!isset($_SESSION['loggato'])){
	header('Location: index.php');
	die();
}

$email = $_SESSION['email'];
echo "<p>Benvenuto ".$email.'</p>';
require_once('db.php');
$ambienti = query("SELECT * FROM appartenenza JOIN ambiente ON appartenenza.id_ambiente=ambiente.id_ambiente WHERE id_utente='$email'");
echo "<ul>";
foreach($ambienti as $ambiente){
	echo '<li><a href="cosergate.php?ambiente='.$ambiente['id_ambiente'].'" >'.$ambiente['nome'].'</a></li>';
}
echo "</ul>";

echo "<p><a href='registra-ambiente.php'>Crea un nuovo ambiente</a></p>";
echo '<a href="cosergate.php?logout=1">Logout</a>';
	
?>
