<?php

require_once("db.php");

$spesa = query("SELECT * FROM spesa WHERE id_spesa={$_POST['id_spesa']}")[0];
$prodotti = query("SELECT * FROM prodotto WHERE id_spesa={$_POST['id_spesa']}");
$utenti = query("SELECT utente.* FROM utente JOIN appartenenza ON utente.id_utente=appartenenza.id_utente WHERE id_ambiente={$_GET['ambiente']};");

echo "<form method='post' action=''>
		<input type='text' name='negozio' value='{$spesa['negozio']}' />
		<input type='text' name='negozio' value='{$spesa['data']}' />
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
	
	echo "<br>";
}

echo "</form>";

echo "<pre>";
print_r($spesa);
print_r($prodotti);
print_r($utenti);
print_r($utilizzi);
?>
