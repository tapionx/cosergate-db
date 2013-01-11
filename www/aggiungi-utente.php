<?php 
session_start();

echo $_SESSION['loggato'];

if(!isset($_SESSION['loggato'])){
		die("Non Loggato.");
		echo '<a href="index.html">Fai il login</a>';
}
?>
