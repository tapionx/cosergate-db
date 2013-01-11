<?php

require_once("db.php");

$spesa = query("SELECT * FROM spesa WHERE id_spesa={$_POST['id_spesa']}");
$prodotti = query("SELECT * FROM prodotto WHERE id_spesa={$_POST['id_spesa']}");

echo "<form method=''";

header("Content-type:text/plain;");
print_r($spesa);
print_r($prodotti);
?>
