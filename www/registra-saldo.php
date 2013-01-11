<?php

session_start();
require_once("db.php");

query("INSERT INTO pagamento (importo, id_pagante, id_creditore) VALUES ({$_POST['importo']}, '{$_SESSION['email']}', '{$_POST['creditore']}');");
query("UPDATE appartenenza SET saldo = saldo - {$_POST['importo']} WHERE id_utente='{$_POST['creditore']}' AND id_ambiente={$_GET['ambiente']}");
query("UPDATE appartenenza SET saldo = saldo + {$_POST['importo']} WHERE id_utente='{$_SESSION['email']}' AND id_ambiente={$_GET['ambiente']}");
header("Location: cosergate.php?ambiente={$_GET['ambiente']}");
?>
