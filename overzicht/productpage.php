<?php require "index.php";

require "../db/connect.php";

$categoryID = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);
$pageNumber = filter_input(INPUT_GET, 'pageNumber', FILTER_SANITIZE_NUMBER_INT);

$stmt = getProductsByCategory($categoryID);

$producten = array();
while($row = $stmt->fetch()) {
    $producten[$row["id"]] = array("naam" => $row["naam"], "prijs" => $row["prijs"]);
}

$numberOfProducts = 9;
$numberOfPages = ceil(count($producten) / $numberOfProducts);
$pages = array();
for ($i = 0; $i < $numberOfPages; $i++) {
    $pages[$i] = array_slice($producten, $i * $numberOfProducts, $numberOfProducts);
}
?>
<!--
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
      
  </div>-->
<div class="outer-div">
    <?php
    foreach ($pages[$pageNumber] as $id => $gegevens){
        echo "<a href='../product/index.php?product=$id' style='color: black; text-decoration: none;'>";
        echo '<div class="image-border">';
        echo '<img src="https://via.placeholder.com/300" alt="Productimg"><p>';
        echo $gegevens["naam"];
        echo '</p><p>€ ';
        echo $gegevens["prijs"];
        echo '</p></div>';
    }
    ?>
    

</div>
<div class="page-nav">
    <ul>
        <?php 
        for ($i = 0; $i < $numberOfPages; $i++) {
            echo "<li><a href='../overzicht/productpage.php?category=$categoryID&pageNumber=$i' style='color: black; text-decoration: none;'>";
            echo $i + 1;
            echo "</li>";
        }
        ?>        
    </ul>
</div>

<script src="controller.js"></script>
</body>
</html> 