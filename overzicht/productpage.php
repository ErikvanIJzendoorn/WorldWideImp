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
    $producten[$row["id"]] = array("naam" => $row["naam"], "prijs" => $row["prijs"], "voorraad" => $row["voorraad"]);
}

$minPrice = findMinPrice($producten);
$maxPrice = findMaxPrice($producten);

function splitIntoPages($producten, $numberOfPages, $numberOfProducts) {
    $pages = array();
    for ($i = 0; $i < $numberOfPages; $i++) {
        $pages[$i] = array_slice($producten, $i * $numberOfProducts, $numberOfProducts, true);
    }
    return $pages;
}

function findMinPrice($array) {
    $minPrice = PHP_INT_MAX;
    foreach ($array as $product) {
        $actualPrice = $product['prijs'];
        if ($actualPrice < $minPrice) {
            $minPrice = $actualPrice;
        }        
    }
    return $minPrice;
}

function findMaxPrice($array) {
    $maxPrice = PHP_INT_MIN;
    foreach ($array as $product) {
        $actualPrice = $product['prijs'];
        if ($actualPrice > $maxPrice) {
            $maxPrice = $actualPrice;
        }
    }
    return $maxPrice;
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
    if ($product['prijs'] <= $filterValue) {
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
    default:
        $pages = sortAlpha($pages, $numberOfPages, $numberOfProducts);
        break;
}
?>

<div class="outer-div top-div">
    <div class="filters">  
        <button onclick="showFilter()" class="filter-btn"><i class="fas fa-stream"></i></button>
        <div id="display-filter" class="display-filter">
            <h4>Filters</h4><br>
            <p>Max/min costs</p>
            <div class="slidecontainer">
                <input type="range" class="slider" min="<?=floor($minPrice);?>" max="<?=floor($maxPrice);?>" value="<?=$filterValue;?>" onchange="priceSlider(<?=$categoryID;?>, <?=$pageNumber;?>, <?=$sort;?>, <?=$numberOfProducts;?>, 1, this.value);">
            </div>
            <input type="text" class="sliderValue" value="<?=$filterValue;?>">
        </div>
    </div>
            <span id="product-text">Show:</span>   
            <select class="productAmount" id="productAmount">
                <option value="<?="$categoryID,$pageNumber,$sort,$filter,$filterValue";?>,9" <?php if ($numberOfProducts === "9") {echo "selected";}?>>9</option>
                <option value="<?="$categoryID,$pageNumber,$sort,$filter,$filterValue";?>,15" <?php if ($numberOfProducts === "15") {echo "selected";}?>>15</option>
                <option value="<?="$categoryID,$pageNumber,$sort,$filter,$filterValue";?>,30" <?php if ($numberOfProducts === "30") {echo "selected";}?>>30</option>
                <option value="<?="$categoryID,$pageNumber,$sort,$filter,$filterValue";?>,45" <?php if ($numberOfProducts === "45") {echo "selected";}?>>45</option>
            </select>
            <span id="sort-text">Sort by: </span>
            <select class="sort" id="sort">
                <option value="<?="$categoryID,$numberOfProducts,$pageNumber,$filter,$filterValue";?>,1" <?php if ($sort === "1") {echo "selected";}?>>Name A - Z</option>
                <option value="<?="$categoryID,$numberOfProducts,$pageNumber,$filter,$filterValue";?>,2" <?php if ($sort === "2") {echo "selected";}?>>Name Z - A</option>
                <option value="<?="$categoryID,$numberOfProducts,$pageNumber,$filter,$filterValue";?>,3" <?php if ($sort === "3") {echo "selected";}?>>Price low - high</option>
                <option value="<?="$categoryID,$numberOfProducts,$pageNumber,$filter,$filterValue";?>,4" <?php if ($sort === "4") {echo "selected";}?>>Price high - low</option>
            </select>
    </div>
</div>
<a href="#"  id="scroll-btn" style="display: none;"><span></span></a>
<div class="outer-div bottom-div">
    <?php

    switch ($categoryID) {
        case 1:
            $productimg = "../img/products/Novelty";
            break;
        case 2:
            $productimg = "../img/products/Hoodie";
            break;
        case 3:
            $productimg = "../img/products/Mug";
            break;
        case 4:
            $productimg = "../img/products/T-shirt";
            break;
        case 6:
            $productimg = "../img/products/Novelty";
            break;
        case 7:
            $productimg = "../img/products/Usb";
            break;
        case 8:
            $productimg = "../img/products/Slippers";
            break;
        case 9:
            $productimg = "../img/products/Toy";
            break;
        case 10:
            $productimg = "../img/products/Materials";
            break;
    }
    
    foreach ($pages[$pageNumber] as $id => $gegevens){
        $imgindex = rand(1,3);
        echo "<a href='../product/index.php?product=$id'>";
        echo '<div class="image-border">';
        echo "<img src='$productimg$imgindex.jpg' alt='Productimg'><p>";
        echo $gegevens["naam"];
        echo '</p><div>€ ';
        echo $gegevens["prijs"];
        if($gegevens['voorraad'] >= 100) {
            echo '<div style="background: green; border-radius: 100%; width: 15px; height: 15px; float: right;"></div>';
        } else if ($gegevens['voorraad'] < 100 && $gegevens['voorraad'] > 10) {
            echo '<div style="background: orange; border-radius: 100%; width: 15px; height: 15px; float: right;"></div>';
        } else {
            echo '<div style="background: red; border-radius: 100%; width: 15px; height: 15px; float: right;"></div>';
        }  
        echo '</div></div>';
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
    
<?php require "../main/footer.php"; ?>

<script>
function showFilter() {
    var element = document.getElementById("display-filter");
    element.classList.toggle("show-filter");
}


$(document).ready(function(){ 
    $(window).scroll(function(){ 
        if ($(this).scrollTop() > 400) { 
            $('#scroll-btn').fadeIn(); 
        } else { 
            $('#scroll-btn').fadeOut(); 
        } 
    }); 
    $('#scroll-btn').click(function(){ 
        $("html, body").animate({ scrollTop: 230 }, 600); 
        return false; 
    }); 
});
</script>
</body>
</html> 