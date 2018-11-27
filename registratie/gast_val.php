<?php 

require '../db/connect.php';

var_dump($_POST);

if(isset($_POST)) {
	$fname = $_POST['firstName'];
	$lname = $_POST['lastName'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$zip = $_POST['zip'];http://localhost/worldWideImp/registratie/gast_val.php
	$city = $_POST['city'];	
	$method = $_POST['paymentMethod'];
	$ccbank = $_POST['bank'];
	$ccname = $_POST['cc-name'];
	$cciban = $_POST['cc-iban'];
	$ccnumber = $_POST['cc-number'];

	$name = $fname . " " . $lname;
	Register($name, $email, $address, $zip, $city, $method, $ccbank, $ccname, $cciban, $ccnumber);
}

?>