<?php 

if (isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['voornaam']) && 
	isset($_POST['achternaam']) && isset($_POST['adres']) && isset($_POST['plaats']) && 
	isset($_POST['postcode']) ) {
	
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$voornaam = $_POST['voornaam'];
	$achternaam = $_POST['achternaam'];
	$adres = $_POST['adres'];
	$plaats = $_POST['plaats'];
	$postcode = $_POST['postcode'];

	register($user, $pass, $voornaam, $achternaam, $adres, $plaats, $postcode);
}




?>