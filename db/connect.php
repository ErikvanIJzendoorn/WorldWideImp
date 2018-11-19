<?php 
function connect(){
	$db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
	$user = "root";
	$pass = "";
	$pdo = new PDO($db, $user, $pass);
	return $pdo;
}

// Get a single product from the DB
if(!function_exists("getProduct")){
    function getProduct($productID) {
            try{
                    $pdo = connect();
                    $stmt = $pdo->prepare("
                            SELECT StockItemName naam, SG.StockGroupName categorie, CustomFields herkomst, PackageTypeName verpakking, ColorName kleur, UnitPrice prijs, TaxRate btw, QuantityOnHand voorraad, S.StockItemID itemID, SG.StockGroupID categorieID, C.ColorID kleurID, P.PackageTypeID verpakkingID FROM StockItems S LEFT JOIN Colors C ON S.ColorID = C.ColorID LEFT JOIN PackageTypes P ON S.UnitPackageID = P.PackageTypeID LEFT JOIN StockItemHoldings H ON S.StockItemID = H.StockItemID LEFT JOIN StockItemStockGroups SS ON S.StockItemID = SS.StockItemID LEFT JOIN StockGroups SG ON SS.StockGroupID = SG.StockGroupID WHERE S.StockItemID = ?
                    ");

                    $stmt->execute(array($productID));
                    return $stmt;
            }catch (PDOException $e)
        {
            return $e;
        }
    }
}

function getCategory(){
	try {
		$pdo = connect();
		$stmt = $pdo->prepare("
			SELECT SG.StockGroupName naam, SG.StockGroupID id
			FROM StockGroups SG
			JOIN stockitemstockgroups USING(StockGroupID)
			JOIN StockItems S USING(StockItemID)
			GROUP BY SG.StockGroupID");

			$stmt->execute();
			return $stmt;
	}catch (PDOException $e)
    {
        return $e;
    }
}

if(!function_exists('getProductsByCategory')){
    function getProductsByCategory($category) {
    try {
        $pdo = connect();
        $stmt = $pdo->prepare("SELECT SI.StockItemID id, StockItemName naam, UnitPrice prijs FROM StockItems SI "
                . "JOIN StockItemStockGroups SISG ON SI.StockItemID = SISG.StockItemID "
                . "WHERE StockGroupID = ?");
        
        $stmt->execute(array($category));
        return $stmt;
    } catch (PDOException $e) {
        return $e;
    }
}
}
function Register($user, $pass, $voornaam, $achternaam, $adres, $plaats, $postcode){
   
}

function Login($user, $pass){
    try {
            $pdo = connect();
            $stmt = $pdo->prepare("SELECT CustomerEmail, CustomerPassword FROM clogin WHERE CustomerEmail = :user AND CustomerPassword = :pass");
            $stmt->bindValue(':user', $user);
            $stmt->bindValue(':pass', $pass);

            $stmt->execute();
			return $stmt;
    } catch (Exception $e) {
        return $e;
    }
}