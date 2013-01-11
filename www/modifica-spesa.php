<?php

require_once("db.php");

$spesa = query("SELECT * FROM spesa WHERE id_spesa={$_POST['id_spesa']}")[0];
$prodotti = query("SELECT * FROM prodotto WHERE id_spesa={$_POST['id_spesa']}");

echo "<form method='post' action=''>
		<input type='text' name='negozio' value='{$spesa['negozio']}' />
		<input type='text' name='negozio' value='{$spesa['data']}' />
	  ";

foreach($prodotti as $prodotto){
	echo "<input type='text' name='p[{$prodotto['id_prodotto']}][nome]' value='{$prodotto['nome']}' />
}

	  </form>";

header("Content-type:text/plain;");
print_r($spesa);
print_r($prodotti);
?>
