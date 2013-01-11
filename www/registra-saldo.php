<?php

query("INSERT INTO pagamento (importo, id_pagante, id_creditore) VALUES ({$_POST['importo']}, {$_GET['ambiente']}, {$_POST['creditore']});");
header("Location: cosergate.php?ambiente={$_GET['ambiente']}");
?>
