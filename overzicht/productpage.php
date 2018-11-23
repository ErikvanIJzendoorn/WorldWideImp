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
    <div id="sortBar">
        <form id="sortForm">  
            <select id="sort" name="sort" form="sortForm">
                <option value="<?=$categoryID;?>,<?=$pageNumber;?>,0" <?php if (isset($sort) && $sort === "0") {echo "selected";}?>>Unsorted</option>
                <option value="<?=$categoryID;?>,<?=$pageNumber;?>,1" <?php if (isset($sort) && $sort === "1") {echo "selected";}?>>A to Z</option>
                <option value="<?=$categoryID;?>,<?=$pageNumber;?>,2" <?php if (isset($sort) && $sort === "2") {echo "selected";}?>>Z to A</option>
                <option value="<?=$categoryID;?>,<?=$pageNumber;?>,3" <?php if (isset($sort) && $sort === "3") {echo "selected";}?>>Price Ascending</option>
                <option value="<?=$categoryID;?>,<?=$pageNumber;?>,4" <?php if (isset($sort) && $sort === "4") {echo "selected";}?>>Price Descending</option>
            </select>
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