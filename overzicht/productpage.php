<?php require "index.php";

$categoryID = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);
$pageNumber = filter_input(INPUT_GET, 'pageNumber', FILTER_SANITIZE_NUMBER_INT);
$sort = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_NUMBER_INT);

$stmt = getProductsByCategory($categoryID);

$producten = array();
while($row = $stmt->fetch()) {
    $producten[$row["id"]] = array("naam" => $row["naam"], "prijs" => $row["prijs"]);
}

$numberOfProducts = 9;
$numberOfPages = ceil(count($producten) / $numberOfProducts);

function splitIntoPages($producten, $numberOfPages, $numberOfProducts) {
    $pages = array();
    for ($i = 0; $i < $numberOfPages; $i++) {
        $pages[$i] = array_slice($producten, $i * $numberOfProducts, $numberOfProducts, true);
    }
    return $pages;
}

$pages = splitIntoPages($producten, $numberOfPages, $numberOfProducts);

function sortAlpha($array, $numberOfPages, $numberOfProducts) {
    $combined = $array[0];
    $size = count($array);
    for ($i = 1; $i < $size; $i++) {
        $combined = $combined + $array[$i];
    }
    sort($combined);
    return splitIntoPages($combined, $numberOfPages, $numberOfProducts);
}

function sortRAlpha($array, $numberOfPages, $nubmerOfProducts) {
    $combined = $array[0];
    $size = count($array);
    for ($i = 1; $i < $size; $i++) {
        $combined = $combined + $array[$i];
    }
    sort($combined);
    return splitIntoPages(array_reverse($combined), $numberOfPages, $nubmerOfProducts);
}

if ($sort == 1) {
    $pages = sortAlpha($pages, $numberOfPages, $numberOfProducts);
} else if ($sort == 2) {
    $pages = sortRAlpha($pages, $numberOfPages, $nubmerOfProducts);
}
?>

<div class="outer-div">
    <div id="sortBar">
        <form method="get" action="../overzicht/productpage.php" id="sortForm">      
            <input type="hidden" name="category" value="<?=$categoryID?>">
            <input type="hidden" name="pageNumber" value="0">      
            <select name="sort" form="sortForm">
                <option value="0">Not sorted</option>
                <option value="1">Alphabetical &darr;</option>
                <option value="2">Alphabetical &uarr;</option>
            </select>
            <input type="submit" value="Confirm">
        </form>
    </div>
    <?php
    foreach ($pages[$pageNumber] as $id => $gegevens){
        echo "<a href='../product/index.php?product=$id&category=$categoryID' style='color: black; text-decoration: none;'>";
        echo '<div class="image-border">';
        echo '<img src="https://via.placeholder.com/300" alt="Productimg"><p>';
        echo $gegevens["naam"];
        echo '</p><p>€ ';
        echo $gegevens["prijs"];
        echo '</p></div>';
    }
    ?>
</div>

<div class="bottom">
    <div class="page-nav">
        <a href="../overzicht/productpage.php?category=<?=$categoryID;?>&pageNumber=<?php if($pageNumber > 0) {$pageNumber--;} echo $pageNumber;?>$sort=<?=$sort;?>">&laquo;</a>
            <?php 
            for ($i = 0; $i < $numberOfPages; $i++) {
                echo "<a href='../overzicht/productpage.php?category=$categoryID&pageNumber=$i&sort=$sort' style='color: black; text-decoration: none;'>";
                echo $i + 1;
            }
            ?>
        <a href="../overzicht/productpage.php?category=<?=$categoryID;?>&pageNumber=<?php if($pageNumber < $numberOfPages) {$pageNumber++;} echo $pageNumber;?>&sort=<?=$sort;?>">&raquo;</a>
    </div>
</div>
    
<script src="controller.js"></script>
<?php require "../main/footer.php"; ?>

</body>
</html> 