<?php

query("INSERT INTO commento (testo, id_prodotto, id_utente) VALUES ('{$_POST['commento']}',{$_POST['id_prodotto']},'{$_POST['id_utente']}')");

echo "{$_POST['commento']} su {$_POST['id_prodotto']}";
?>
