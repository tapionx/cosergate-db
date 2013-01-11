<?php

session_start();
require_once("db.php");

query("INSERT INTO pagamento (importo, id_pagante, id_creditore) VALUES ({$_POST['importo']}, {$_SESSION['email']}, {$_POST['creditore']});");
header("Location: cosergate.php?ambiente={$_GET['ambiente']}");
?>
