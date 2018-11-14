<?php require "index.php";

require "../db/connect.php";

$stmt = getProductsByCategory(filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT));

$producten = array();
while($row = $stmt->fetch()) {
    $producten[$row["id"]] = array("naam" => $row["naam"], "prijs" => $row["prijs"]);
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
    foreach ($producten as $id => $gegevens){
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

<script src="controller.js"></script>
</body>
</html> 