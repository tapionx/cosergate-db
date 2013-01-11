<?php
session_start();
require_once('db.php');

if(!isset($_SESSION['loggato'])){
	header("Location: index.php");
	die();
}

// Recupero il numero di utenti
$nutenti = query("SELECT count(id_utente) AS nutenti FROM appartenenza WHERE id_ambiente='{$_GET['ambiente']}';");
$nutenti = $nutenti[0]['nutenti'];

$utenti = query("SELECT * FROM utente JOIN appartenenza ON utente.email=appartenenza.id_utente WHERE id_ambiente='{$_GET['ambiente']}';");

if(isset($_POST['inseriscispesa'])){
	
	$inserisci_spesa = "INSERT INTO spesa (negozio, ambiente, cliente) VALUES ('{$_POST['negozio']}', {$_GET['ambiente']}, '{$_SESSION['email']}');";
	mysql_query($inserisci_spesa, $db) or die("Errore nella INSERT SPESA: $inserisci_spesa");
	echo $inserisci_spesa.'<br>'
	
	$lastid = mysql_insert_id();
	
	foreach($_POST['t'] as $prodotto){
		$costo_per_utilizzatore = $prodotto['costo'] / count($prodotto['email']);
		foreach($prodotto['email'] as $utente){
			query("UPDATE appartenenza SET totale=totale-$costo_per_utilizzatore WHERE id_utente=$utente AND id_ambiente={$_GET['ambiente']}");
		}
		
		query("INSERT INTO prodotto 
								(nome, 
								 quantita, 
								 costo, 
								 descrizione, 
								 spesa ) 
												 
								VALUES ('p',
										{$_POST["quantita-$i"]},
										{$_POST["costo-$i"]},
										'{$_POST["descrizione-$i"]}',
										$lastid );");
	}
	header("Location: cosergate.php?ambiente={$_GET['ambiente']}");
}
?>



<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
	var nprodotti = 1;
	function aggiungi_prodotto(){
		nprodotti += 1;
		var form = "<tr><td><input type='text' name='t["+nprodotti+"][nome]' placeholder='nome'/></td> " + 
				   "<td><input type='text' name='t["+nprodotti+"][quantita]' placeholder='quantita'/></td> " +
				   "<td><input type='text' name='t["+nprodotti+"][costo]' placeholder='costo'/></td> " +
					<?php
					foreach($utenti as $utente){
						echo '"<td><input type=\'checkbox\' name=\'t["+nprodotti+"][email][]\' value=\''.$utente['email'].'\' checked/></td>"+';
					}
					?>
				   "<td><input type='text' name='t["+nprodotti+"][descrizione]' placeholder='descrizione'/> </td>" +
				   "</tr>";
		$('table').append(form);
		$('#nprodotti').attr('value', nprodotti);
	}
</script>




<form method="post" action="">
		<input type="text" name="negozio" placeholder="negozio"/>
		<input type="date" name="data" placeholder="data"/>
<p>Prodotti</p>
		
<table>
	<tr>
		<th>Nome</th>
		<th>Quantità</th>
		<th>Costo</th>
		<?php
		foreach($utenti as $utente)
			echo "<th>{$utente['nome']}</th>";
		?>
		<th>Descrizione</th>
	</tr>
	<tr>
		<td><input type="text" name="t[1][nome]" placeholder="nome"/></td>
		<td><input type="text" name="t[1][quantita]" placeholder="quantita"/></td>
		<td><input type="text" name="t[1][costo]" placeholder="costo"/></td>
		<?php
		foreach($utenti as $utente){
			echo "<td><input type='checkbox' name='t[1][email][]' value='{$utente['email']}' checked/></td>";
		}
		?>
		<td><input type="text" name="t[1][descrizione]" placeholder="descrizione"/></td>
	</tr>
</table>

	<input type="button" name="aggiungiriga" value="Aggiungi prodotto" onclick="aggiungi_prodotto()"/>
	<input id="nprodotti" type="hidden" name="nprodotti" value="3"/>
	<input type="submit" name="inseriscispesa" value="Inserisci"/>
</form>
