<?php require "index.php";

$categoryID = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);
$pageNumber = filter_input(INPUT_GET, 'pageNumber', FILTER_SANITIZE_NUMBER_INT);
$numberOfProducts = filter_input(INPUT_GET, 'productAmount', FILTER_SANITIZE_NUMBER_INT);
$sort = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_NUMBER_INT);
$filter = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_NUMBER_INT);
$filterValue = filter_input(INPUT_GET, 'filterValue', FILTER_SANITIZE_NUMBER_INT);

$stmt = getProductsByCategory($categoryID);

$producten = array();
while($row = $stmt->fetch()) {
    $producten[$row["id"]] = array("naam" => $row["naam"], "prijs" => $row["prijs"]);
}

function splitIntoPages($producten, $numberOfPages, $numberOfProducts) {
    $pages = array();
    for ($i = 0; $i < $numberOfPages; $i++) {
        $pages[$i] = array_slice($producten, $i * $numberOfProducts, $numberOfProducts, true);
    }
    return $pages;
}

function sortAlpha($array, $numberOfPages, $numberOfProducts) {
    $combined = $array[0];
    $size = count($array);
    for ($i = 1; $i < $size; $i++) {
        $combined = $combined + $array[$i];
    }
    asort($combined);
    return splitIntoPages($combined, $numberOfPages, $numberOfProducts);
}

function sortRAlpha($array, $numberOfPages, $numberOfProducts) {
    $combined = $array[0];
    $size = count($array);
    for ($i = 1; $i < $size; $i++) {
        $combined = $combined + $array[$i];
    }
    asort($combined);
    return splitIntoPages(array_reverse($combined, true), $numberOfPages, $numberOfProducts);
}

function sortPrice($array, $numberOfPages, $numberOfProducts) {
    $combined = $array[0];
    $size = count($array);
    for ($i = 1; $i < $size; $i++) {
        $combined = $combined + $array[$i];
    }
    uasort($combined, function ($x, $y) {
        return $x['prijs'] <=> $y['prijs'];
    });
    return splitIntoPages($combined, $numberOfPages, $numberOfProducts);
}

function sortRPrice($array, $numberOfPages, $numberOfProducts) {
    $combined = $array[0];
    $size = count($array);
    for ($i = 1; $i < $size; $i++) {
        $combined = $combined + $array[$i];
    }
    uasort($combined, function ($x, $y) {
        return $x['prijs'] <=> $y['prijs'];
    });
    return splitIntoPages(array_reverse($combined, true), $numberOfPages, $numberOfProducts);
}

function filterOnPrice($product) {
    global $filterValue;
    if ($product['prijs'] >= $filterValue) {
        return true;
    } else {
        return false;
    }
}

switch ($filter) {
    case 1:
        $producten = array_filter($producten, "filterOnPrice");
        break;
}

$numberOfPages = ceil(count($producten) / $numberOfProducts);

if ($pageNumber >= $numberOfPages) {
    $pageNumber = $numberOfPages - 1;
}

$pages = splitIntoPages($producten, $numberOfPages, $numberOfProducts);

switch ($sort) {
    case 1:
        $pages = sortAlpha($pages, $numberOfPages, $numberOfProducts);
        break;
    case 2:
        $pages = sortRAlpha($pages, $numberOfPages, $numberOfProducts);
        break;
    case 3:
        $pages = sortPrice($pages, $numberOfPages, $numberOfProducts);
        break;
    case 4:
        $pages = sortRPrice($pages, $numberOfPages, $numberOfProducts);
        break;
}
?>

<div class="outer-div">
    <div>
        <input type="range" min="0" max="100" value="<?=$filterValue;?>" onchange="priceSlider(<?=$categoryID;?>, <?=$pageNumber;?>, <?=$sort;?>, <?=$numberOfProducts;?>, 1, this.value);">
        <input type="text" id="sliderValue" value="<?=$filterValue;?>">
    </div>
    <div>
        <select id="productAmount" name="productAmount">
            <option value="<?="$categoryID,$pageNumber,$sort,$filter,$filterValue";?>,45" <?php if ($numberOfProducts === "45") {echo "selected";}?>>45</option>
            <option value="<?="$categoryID,$pageNumber,$sort,$filter,$filterValue";?>,30" <?php if ($numberOfProducts === "30") {echo "selected";}?>>30</option>
            <option value="<?="$categoryID,$pageNumber,$sort,$filter,$filterValue";?>,15" <?php if ($numberOfProducts === "15") {echo "selected";}?>>15</option>
            <option value="<?="$categoryID,$pageNumber,$sort,$filter,$filterValue";?>,9" <?php if ($numberOfProducts === "9") {echo "selected";}?>>9</option>
        </select>
    </div>
    <div id="sortBar"> 
        <select id="sort" name="sort">
            <option value="<?="$categoryID,$numberOfProducts,$pageNumber,$filter,$filterValue";?>,0" <?php if ($sort === "0") {echo "selected";}?>>Unsorted</option>
            <option value="<?="$categoryID,$numberOfProducts,$pageNumber,$filter,$filterValue";?>,1" <?php if ($sort === "1") {echo "selected";}?>>A to Z</option>
            <option value="<?="$categoryID,$numberOfProducts,$pageNumber,$filter,$filterValue";?>,2" <?php if ($sort === "2") {echo "selected";}?>>Z to A</option>
            <option value="<?="$categoryID,$numberOfProducts,$pageNumber,$filter,$filterValue";?>,3" <?php if ($sort === "3") {echo "selected";}?>>Price Ascending</option>
            <option value="<?="$categoryID,$numberOfProducts,$pageNumber,$filter,$filterValue";?>,4" <?php if ($sort === "4") {echo "selected";}?>>Price Descending</option>
        </select>
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
        <a href="../overzicht/productpage.php?category=<?=$categoryID;?>&pageNumber=<?php if($pageNumber > 0) {$pageNumber--;} echo $pageNumber;?>$sort=<?=$sort;?>&productAmount=<?=$numberOfProducts;?>&filter=<?=$filter;?>&filterValue=<?=$filterValue;?>">&laquo;</a>
            <?php 
            for ($i = 0; $i < $numberOfPages; $i++) {
                echo "<a href='../overzicht/productpage.php?category=$categoryID&pageNumber=$i&sort=$sort&productAmount=$numberOfProducts&filter=$filter&filterValue=$filterValue' style='color: black; text-decoration: none;'>";
                echo $i + 1;
            }
            ?>
        <a href="../overzicht/productpage.php?category=<?=$categoryID;?>&pageNumber=<?php if($pageNumber < $numberOfPages) {$pageNumber++;} echo $pageNumber;?>&sort=<?=$sort;?>&productAmount=<?=$numberOfProducts;?>&filter=<?=$filter;?>&filterValue=<?=$filterValue;?>">&raquo;</a>
    </div>
</div>
    
<script src="controller.js"></script>
<?php require "../main/footer.php"; ?>

</body>
</html> 