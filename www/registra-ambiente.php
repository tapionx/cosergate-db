<?php

if(isset($_POST['aggiungi'])) {
	require_once('db.php');
	$nome = $_POST['nome'];
	$via = $_POST['via'];
	$citta  = $_POST['citta'];
	$numero = $_POST['numero'];
	$query = "SELECT * FROM utente WHERE email='$email';";
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

<h1>Registra ambiente</h1>
<form method="post" action="">
<input type="text" name="nome" placeholder="nome" required="required"/>
<br>
<input type="text" name="citta" placeholder="città" /> 
<br>
<input type="text" name="via" placeholder="via" />
<br>
<input type="text" name="numero" placeholder="numero" />
<br>
<input type="text" name="cap" placeholder="cap" />
<br>
<input type="submit" name="aggiungi" value="Aggiungi" />
</form>


