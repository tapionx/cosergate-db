<?php

session_start();
require_once('db.php');

if(!isset($_SESSION['loggato'])){
	header("Location: index.php");
	die();
}

if(isset($_POST['inseriscispesa'])){
	
	$inserisci_spesa = "INSERT INTO spesa (negozio, ambiente, cliente) VALUES ('{$_POST['negozio']}', 3, '{$_SESSION['email']}');";
	
	die();
}

?>

<form method="post" action="">
	<input type="text" name="negozio" placeholder="negozio"/>
	<input type="date" name="data" placeholder="data"/>
	<p>Prodotti</p>
	<input type="text" name="nome-1" placeholder="nome"/>
	<input type="text" name="quantita-1" placeholder="quantita"/>
	<input type="text" name="costo-1" placeholder="costo"/>
	<input type="text" name="descrizione-1" placeholder="descrizione"/>
	<br/>
	<input type="text" name="nome-2" placeholder="nome"/>
	<input type="text" name="quantita-2" placeholder="quantita"/>
	<input type="text" name="costo-2" placeholder="costo"/>
	<input type="text" name="descrizione-2" placeholder="descrizione"/>
	<br/>
	<input type="text" name="nome-3" placeholder="nome"/>
	<input type="text" name="quantita-3" placeholder="quantita"/>
	<input type="text" name="costo-3" placeholder="costo"/>
	<input type="text" name="descrizione-3" placeholder="descrizione"/>
	<br/>
	<input type="hidden" name="nprodotti" value="3"/>
	<input type="submit" nome="inseriscispesa" value="Inserisci"/>
</form>
