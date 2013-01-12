<!DOCTYPE html>
<html>
	<head>
		<title>Cosergate</title>
	</head>
	<body>
<?php

if(isset($_POST['registra'])) {
	require_once('db.php');
	$email = $_POST['email'];
	$nome  = $_POST['nome'];
	$cognome  = $_POST['cognome'];
	$password = md5($_POST['password']);
	$nomeutente = $_POST['nomeutente'];
	$query = "SELECT * FROM utente WHERE id_utente='$email';";
	$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
	if(mysql_num_rows($esiste) == 0){
		$query = "INSERT INTO utente VALUES('$email', '$nome', '$cognome', '$password', '$nomeutente');";
		mysql_query($query, $db) or die('Errore nella INSERT');
		header("Location: index.php");
	} else {
		echo "<h1>Questa email è già registrata.</h1>";
	}
}

?>

<h1>Registrati</h1>
<form method="post" action="">
<input type="text" name="email" placeholder="email" />
<br>
<input type="text" name="nomeutente" placeholder="nome visualizzato" />
<br>
<input type="text" name="nome" placeholder="nome" />
<br>
<input type="text" name="cognome" placeholder="cognome" />
<br>
<input type="password" name="password" placeholder="password" /> 
<br>
<input type="submit" name="registra" value="Registrati" />
</form>


