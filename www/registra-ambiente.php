<!DOCTYPE html>
<html>
	<head>
		<title>Cosergate</title>
		<meta charset="utf-8">
		
	</head>
	<body>
<?php
session_start();
if(isset($_POST['aggiungi'])) {
	require_once('db.php');
	$nome = $_POST['nome'];
	$via = $_POST['via'];
	$citta  = $_POST['citta'];
	$numero = $_POST['numero'];
	$cap = $_POST['cap'];
	$query = "INSERT INTO ambiente VALUES(NULL, '$citta', '$via', '$cap', '$numero', '$nome');";
	$ret = mysql_query($query, $db) or die('Errore nella INSERT');
	$lastid = mysql_insert_id();
	$query = "INSERT INTO appartenenza VALUES($lastid, '${_SESSION['email']}', 0);";
	mysql_query($query, $db) or die('Errore nella INSERT');
	header("Location: cosergate.php?ambiente=$lastid");
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

	</body>
</html>
