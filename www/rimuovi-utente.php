<?php 
session_start();
require_once('db.php');

if(!isset($_SESSION['loggato'])){
		die("Non Loggato.");
		echo '<a href="index.php">Fai il login</a>';
}

if(!isset($_GET['ambiente'])){
		die("Nessun ambiente selezionato.");
		echo '<a href="lista-ambienti.php">Seleziona un ambiente.</a>';
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

if(isset($_POST['rimuovi'])){
	$email = $_POST['email'];
	
	if($email != $_SESSION['email']){ /* Controllo se sto aggiungendo me stesso */
		$query = "SELECT * FROM utente WHERE email='$email'";
		$utente = mysql_query($query, $db) or die('Errore nella SELECT');

		if( mysql_num_rows($utente) == 1){ /* controllo se la mail esiste */
			
			$query = "SELECT * FROM appartenenza WHERE id_utente='$email' AND id_ambiente=".$_GET['ambiente'];
			$utente = mysql_query($query, $db) or die('Errore nella select');
			
			if(mysql_num_rows($utente) == 0){ /* controllo se la mail non esite già nell'ambiente */
				$query = "INSERT INTO appartenenza VALUES('{$_GET['ambiente']}','$email',0)";
				$utente = mysql_query($query, $db) or die('Errore nell\'inserimento dell\'utente');
				echo "Utente aggiunto!";
			}else{
					echo "Utente già presente";
			}
		} else {
			echo "Email errata.";
		}
	}else{
		echo "Non puoi aggiungere te stesso furbacchione. =)";
	}
}
?>

<form method="post" action="">
	<input type="text" placeholder="email utente" name="email">
	<input type="submit" value="Aggiungi" name="aggiungi">
</form>

<?php 
echo '<a href="cosergate.php?ambiente='.$_GET['ambiente'].'">Torna indietro</a>';
?>
