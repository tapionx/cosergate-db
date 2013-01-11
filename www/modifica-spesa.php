<?php

require_once("db.php");

$spesa = query("SELECT * FROM spesa WHERE id_spesa={$_POST['id_spesa']}");
header("Content-type:text/plain;");
print_r($spesa);
?>
