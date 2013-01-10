<?php

require_once('db.php');
$email = $_POST['email'];
$password = md5($_POST['password']);

$query = "SELECT * FROM utente WHERE email='$email' AND password='$password'";

$utenti = mysql_query($query, $db) or die('Errore nella SELECT');

if( mysql_num_rows($utenti) != 1){
	header('Location: index.php');
} else {
	session_start();
	$_SESSION['loggato'] = TRUE;
	$_SESSION['email'] = $email;
	header('Location: lista-ambienti.php');
}
?>
