<?php 

require "db/connect.php";
//header("Location: landing/index.php");

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

print($naam . "<br>");
print($categorie . "<br>");
print($herkomst[2] . "<br>");
print($verpakking . "<br>");
if(isset($kleur)) {
	print($kleur . "<br>");
} else {
	print("Geen kleur meegegeven") . "<br>";
}

print("€ $prijs verkoopprijs <br>");
print("€ $btw btw <br>");
print($voorraad . "<br>");
print($ItemID . "<br>");
print($categorieID . "<br>");
if(isset($kleurID)) {
	print($kleurID . "<br>");
} else {
	print("Geen kleur ID meegegeven" . "<br>");
}
print($verpakkingID . "<br>");

?>