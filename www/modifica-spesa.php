<!DOCTYPE html>
<html>
	<head>
		<title>Cosergate</title>
		<meta charset="utf-8">
		
	</head>
	<body>
<?php

session_start();
require_once("db.php");

if(isset($_POST['spesamodificata'])){
	
	query("UPDATE spesa SET data='{$_POST['data']}', negozio='{$_POST['negozio']}' WHERE id_spesa={$_POST['id_spesa']}");
	
	foreach($_POST['p'] as $id_prodotto => $prodotto) {
		
		$utilizzi = query("SELECT * FROM utilizzo WHERE id_prodotto=$id_prodotto");
		$prodotto_old = query("SELECT * FROM prodotto WHERE id_prodotto=$id_prodotto");

		$costo_per_utilizzatore_old = $prodotto_old['costo'] / count($utilizzi);
		
		query("UPDATE appartenenza SET saldo = saldo - {$prodotto_old['costo']} WHERE id_utente='{$prodotto_old['id_']}' AND id_ambiente={$_GET['ambiente']}");
		
		
		query("UPDATE prodotto SET nome='{$prodotto['nome']}', quantita={$prodotto['quantita']}, costo={$prodotto['costo']}, descrizione='{$prodotto['descrizione']}' WHERE id_prodotto=$id_prodotto");
		query("DELETE FROM utilizzo WHERE id_prodotto=$id_prodotto");
		foreach($prodotto['utenti'] as $utilizzo) {
			query("INSERT INTO utilizzo (id_prodotto, id_utente) VALUES ({$id_prodotto}, '{$utilizzo}');");
		}
	}

	header("Content-type:text/plain;");
	print_r($_POST);
	die();
}


$spesa = query("SELECT * FROM spesa WHERE id_spesa={$_POST['id_spesa']}")[0];
$prodotti = query("SELECT * FROM prodotto WHERE id_spesa={$_POST['id_spesa']}");
$utenti = query("SELECT utente.* FROM utente JOIN appartenenza ON utente.id_utente=appartenenza.id_utente WHERE id_ambiente={$_GET['ambiente']};");

echo "<form method='post' action=''>
		<input type='hidden' name='id_spesa' value='{$_POST['id_spesa']}' />
		<input type='text' name='negozio' value='{$spesa['negozio']}' />
		<input type='text' name='data' value='{$spesa['data']}' />
		<br>
	  ";
?>

<table>
	<tr>
		<th>Nome</th>
		<th>Quantità</th>
		<th>Costo</th>
		<th>Descrizione</th>
<?php
foreach($utenti as $utente){
	echo "<th>{$utente['username']}</th>";
}
echo "</tr><tr>";
foreach($prodotti as $prodotto){
	echo "<td><input type='text' name='p[{$prodotto['id_prodotto']}][nome]' value='{$prodotto['nome']}' /></td>
		  <td><input type='text' name='p[{$prodotto['id_prodotto']}][quantita]' value='{$prodotto['quantita']}' /></td>
		  <td><input type='text' name='p[{$prodotto['id_prodotto']}][costo]' value='{$prodotto['costo']}' /></td>
		  <td><input type='text' name='p[{$prodotto['id_prodotto']}][descrizione]' value='{$prodotto['descrizione']}' /></td>
	";
	
	foreach($utenti as $utente){
		echo "<td><input type='checkbox' name='p[{$prodotto['id_prodotto']}][utenti][]' value='{$utente['id_utente']}'";
		$utilizzi = query("SELECT id_utente FROM utilizzo WHERE id_prodotto={$prodotto['id_prodotto']} AND id_utente='{$utente['id_utente']}';");
		if(!empty($utilizzi)){
			echo " checked ";
		}
		echo " /></td>";
	}
	
	echo "</tr>";
}

echo "</table>";

echo "<input type='submit' name='spesamodificata' value='Modifica' />";

echo "</form>";

echo "<pre>";
print_r($spesa);
print_r($prodotti);
print_r($utenti);
print_r($utilizzi);

?>
	</body>
</html>
