<?php

$productID = filter_input(INPUT_GET, 'product', FILTER_SANITIZE_NUMBER_INT);

$stmt = getProduct($productID);

while($row = $stmt->fetch()) {
	$naam = $row['naam'];
	$categorie = $row['categorie'];
    $categoryID = $row['categorieID'];
	$herkomst = $row['herkomst'];
	$verpakking = $row['verpakking'];
	$kleur = $row['kleur'];
	$prijs = $row['prijs'];
	$btw = $row['btw'];
	$comments = $row['comments'];
	$weight = $row['weight'];
	$tags = $row['tags'];
	$voorraad = $row['voorraad'];
	$ItemID = $row['itemID'];
	$categorieID = $row['categorieID'];
	$kleurID = $row['kleurID'];
	$verpakkingID = $row['verpakkingID'];
}

$tags = str_replace(array('"', "{", "}", "[", "]", "-", ":"), "", $tags);
$tags = explode(",", $tags);

$herkomst = str_replace(array('"', "{", "}", "[", "]", "-", ":", ","), "", $herkomst);
$herkomst = explode(" ", $herkomst);