<?php

$stmt = getProduct();

while($row = $stmt->fetch()) {
	$naam = $row['naam'];
	$categorie = $row['categorie'];
	$herkomst = $row['herkomst'];
	$verpakking = $row['verpakking'];
	$kleur = $row['kleur'];
	$prijs = $row['prijs'];
	$btw = $row['btw'];
	$voorraad = $row['voorraad'];
	$ItemID = $row['itemID'];
	$categorieID = $row['categorieID'];
	$kleurID = $row['kleurID'];
	$verpakkingID = $row['verpakkingID'];
}

$herkomst = str_replace(array('"', "{", "}", "[", "]", "-", ":", ","), "", $herkomst);
$herkomst = explode(" ", $herkomst);

?>