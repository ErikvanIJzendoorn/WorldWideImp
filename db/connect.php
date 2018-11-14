<?php 
if(!function_exists('connect')) {
	function connect(){
		$db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
		$user = "root";
		$pass = "";
		$pdo = new PDO($db, $user, $pass);
		return $pdo;
	}
}


// Get a single product from the DB
if(!function_exists("getProduct")){
function getProduct() {
	try{
		$pdo = connect();
		$stmt = $pdo->prepare("
			SELECT StockItemName naam, SG.StockGroupName categorie, CustomFields herkomst, PackageTypeName verpakking, ColorName kleur, UnitPrice prijs, TaxRate btw, QuantityOnHand voorraad, S.StockItemID itemID, SG.StockGroupID categorieID, C.ColorID kleurID, P.PackageTypeID verpakkingID FROM StockItems S LEFT JOIN Colors C ON S.ColorID = C.ColorID LEFT JOIN PackageTypes P ON S.UnitPackageID = P.PackageTypeID LEFT JOIN StockItemHoldings H ON S.StockItemID = H.StockItemID LEFT JOIN StockItemStockGroups SS ON S.StockItemID = SS.StockItemID LEFT JOIN StockGroups SG ON SS.StockGroupID = SG.StockGroupID WHERE S.StockItemID = 1 AND SG.StockGroupID = 6
		");

		$stmt->execute();
		return $stmt;
	}catch (PDOException $e)
    {
        return $e;
    }
	}
}

if(!function_exists("getCategory")){
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
}
?>