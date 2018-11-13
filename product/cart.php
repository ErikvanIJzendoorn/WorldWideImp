<?php 
session_start();

$item = $_SESSION['item'];
$aantal = $_GET['aantal'];

$item['aantal'] = $_GET['aantal'];

$cart = [];

array_push($cart, $item);

$_SESSION['cart'] = $cart;

/*

cart = array
cart heeft item
item = array
item heeft:

- id
- naam
- aantal
- prijs

*/
?>