<style>
	table {
		border-collapse: collapse;
	}
</style>
<?php

session_start();
require_once('db.php');

/* logout? */
if(isset($_GET['logout'])){
	 session_unset();
	 header('Location: index.php');
}

/* Utente loggato? */

if(!isset($_SESSION['loggato']) || (!isset($_GET['ambiente']))) {
	header('Location: index.php');
	die('1');
}

/* Controllo se esiste l'ambiente */

$query = "SELECT * FROM ambiente WHERE id_ambiente={$_GET['ambiente']}";
$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
if(mysql_num_rows($esiste) == 0){
	die('2');
}
 /* controllo se l'utente appartiene all'ambiente */
 
$query = "SELECT * FROM appartenenza WHERE id_ambiente={$_GET['ambiente']} AND id_utente='{$_SESSION['email']}'";
$esiste = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
if(mysql_num_rows($esiste) == 0){
	die('3');
}


 echo '<p><a href="aggiungi-utente.php?ambiente='.$_GET['ambiente'].'">Aggiungi Utente</a></p>';
 echo '<p><a href="rimuovi-utente.php?ambiente='.$_GET['ambiente'].'">Rimuoviti dall\'ambiente</a></p>';
 echo '<p><a href="lista-ambienti.php">Seleziona un altro ambiente</a></p>';
 echo '<p><a href="cosergate.php?logout=1">Logout</a></p>';

?>
<p>Resoconto Situazione</p>
<?php
$query = "SELECT count(id_utente) AS nutenti FROM appartenenza WHERE id_ambiente={$_GET['ambiente']};";
$nutenti = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
$nutenti = mysql_fetch_assoc($nutenti)['nutenti'];

$utenti = query("SELECT username, saldo, nome, utente.id_utente FROM appartenenza JOIN utente ON appartenenza.id_utente=utente.id_utente WHERE id_ambiente={$_GET['ambiente']};");

$query = "SELECT count(id_utente) AS nutenti FROM appartenenza WHERE id_ambiente={$_GET['ambiente']};";
$nutenti = mysql_query($query, $db) or die("Errore nella SELECT: '$query'");
$nutenti = mysql_fetch_assoc($nutenti)['nutenti'];

echo "<table border=1><tr>";
foreach($utenti as $utente) {
	echo "<td>{$utente['username']}</td>";
}

echo '<tr>';
foreach($utenti as $utente) {
	echo "<td>{$utente['saldo']}</td>";
}
echo '</tr>';

echo "</tr></table>";
?>

<p>Vuoi restituire dei soldi a qualcuno?</p>
<form method="post" action="registra-saldo.php?ambiente=<?php echo $_GET['ambiente']; ?>">
	<input type="text" name="importo" placeholder="Importo"/>
	<select name="creditore">
<?php
	foreach($utenti as $utente){
		echo "<option value='{$utente['id_utente']}'/>{$utente['username']}</option>";
	}
?>
	</select>
	<input type="submit" value="Paga" onclick="return confirm('Sei sicuro?')"/>
</form>

<p>Lista delle spese</p>

<form method="get" action="registra-spesa.php">
<input type="hidden" name="ambiente" value="<?php echo $_GET['ambiente']; ?>"/>
<input type="submit" value="Inserisci una spesa" />
</form>

<?php
$spese = query("SELECT * FROM spesa WHERE id_ambiente={$_GET['ambiente']}");

echo "<table border=1>";
foreach($spese as $spesa){
	$col = 3 + $nutenti;
	echo "<tr>
			<td colspan='$col' >Spesa fatta da {$spesa['id_utente']} il {$spesa['data']} nel negozio {$spesa['negozio']}</td>
			<td>
				<form method='post' action='modifica-spesa.php?ambiente={$_GET['ambiente']}'>
					<input type='submit' name='modifica' value='Modifica' />
					<input type='hidden' name='id_spesa' value='{$spesa['id_spesa']}'/>
			    </form>
			    <form method='post' action='elimina-spesa.php?ambiente={$_GET['ambiente']}'>
					<input type='submit' name='modifica' value='Modifica' />
					<input type='hidden' name='id_spesa' value='{$spesa['id_spesa']}'/>
			    </form>
			</td>
		  </tr>";
	/*
	echo "<tr>
			<th>Negozio</th>
			<th>Data</th>
			<th>Acquirente</th>
		  </tr>
		  <tr>
			<td>{$spesa['negozio']}</td>
			<td>{$spesa['data']}</td>
			<td>{$spesa['id_utente']}</td>
		  </tr>
	";
	*/
	
	$prodotti = query("SELECT * FROM prodotto WHERE id_spesa={$spesa['id_spesa']};");
	foreach($prodotti as $prodotto){
		echo "<tr>
				<th>Nome</th>
				<th>Quantità</th>
				<th>Prezzo</th>
				<th>Descrizione</th>
		";
		foreach($utenti as $utente){
			echo "<th>{$utente['username']}</th>";
		}
		echo "</tr>";
		
		echo "<tr>
				<td>{$prodotto['nome']}</td>
				<td>{$prodotto['quantita']}</td>
				<td>{$prodotto['costo']}</td>
				<td>{$prodotto['descrizione']}</td>";
		foreach($utenti as $utente){
			$utilizzo = query("SELECT * FROM utilizzo WHERE id_prodotto={$prodotto['id_prodotto']} AND id_utente='{$utente['id_utente']}';");
			if(!empty($utilizzo)){
				echo "<td>X</td>";
			} else {
				echo "<td></td>";
			}
		}	
	}
	echo "<form method='post' action='registra-commento.php?ambiente={$_GET['ambiente']}'>
			  <tr>
				<td  colspan='$col'><input type='text' name='commento' placeholder='aggiungi commento'/></td>
				<td><input type='submit' value='Commenta'/></td>
			  </tr>
			<input type='hidden' name='id_prodotto' value='{$prodotto['id_prodotto']}'/>
	      </form>";
	$commenti = query("SELECT * FROM commento WHERE id_prodotto={$prodotto['id_prodotto']}");
	foreach($commenti as $commento){
		echo "<tr>
				<td colspan='$col'>{$commento['testo']}</td>
				<td>{$commento['id_utente']}</td>
			  </tr>";
	}
}
echo "</table>";	


?>


