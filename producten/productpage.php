<?php require "index.php";

require "../db/connect.php";
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

?>

  <div class="navbar navbar-nav ml-auto" id="topNavbar">
		<a href="#" class="navbar-item">Category1</a>
		<a href="#" class="navbar-item">Category2</a>
    <a href="#" class="navbar-item">Category3</a>
    <a href="#" class="navbar-item">Category4</a>
    <a href="#" class="navbar-item">Category5</a>
    <a href="#" class="navbar-item">Category6</a>
    <a href="#" class="navbar-item">Category7</a>
    <a href="#" class="navbar-item">Category8</a>
    <a href="#" class="navbar-item">Category9</a>
  <div class="fas fa-search search"></div>
	</div>

  
  <div class="content">
    <div class="product-name">
      <p>
        <?=$naam; ?>
      </p>
    </div>
    <div class="picture">
      <img src="#" />
    </div>
    <div class="product-description">
      <p>
        <?=$naam; ?>
      </p>
      <br>
      <p class="product-price">
        <?="€" . $prijs; ?>
      </p>
      <div id="bestelamnt">
        <input type="number" name="amount" value="1">
      </div> 
      <p id="available">
        <?="De voorraad is: " . $voorraad; ?>
      </p>
      <button id="bestelbtn">
        Bestel
      </button>
    </div>
      
  </div>
<div class="try"></div>

<script src="controller.js"></script>
</body>
</html> 