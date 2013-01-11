<?php
session_start();
require_once("db.php");

query("INSERT INTO commento (testo, id_prodotto, id_utente) VALUES ('{$_POST['commento']}',{$_POST['id_prodotto']},'{$_SESSION['email']}')");

echo "{$_POST['commento']} su {$_POST['id_prodotto']}";
?>
