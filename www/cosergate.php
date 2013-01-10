<?php

session_start();

if(!isset($_SESSION['loggato']) || (!isset($_GET['ambiente']) || !isset($_SESSION['ambiente']) )))
	die('furbacchione');

if(!isset($_GET['ambiente'])

?>
