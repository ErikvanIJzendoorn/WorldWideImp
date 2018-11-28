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
    function getProduct($productID, $categoryID) {
            try{
                    $pdo = connect();
                    $stmt = $pdo->prepare("
                            SELECT StockItemName naam, SG.StockGroupName categorie, CustomFields herkomst, PackageTypeName verpakking, ColorName kleur, UnitPrice prijs, TaxRate btw, QuantityOnHand voorraad, S.StockItemID itemID, SG.StockGroupID categorieID, C.ColorID kleurID, P.PackageTypeID verpakkingID FROM StockItems S LEFT JOIN Colors C ON S.ColorID = C.ColorID LEFT JOIN PackageTypes P ON S.UnitPackageID = P.PackageTypeID LEFT JOIN StockItemHoldings H ON S.StockItemID = H.StockItemID LEFT JOIN StockItemStockGroups SS ON S.StockItemID = SS.StockItemID LEFT JOIN StockGroups SG ON SS.StockGroupID = SG.StockGroupID WHERE S.StockItemID = ? AND SG.StockGroupID = ?
                    ");

                    $stmt->execute(array($productID, $categoryID));
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

function Register($naam, $email, $address, $zip, $city, $method, $bank, $ccname, $cciban, $ccnumber, $type){
    try {
            $pdo = connect();
        $stmt = $pdo->prepare("INSERT INTO customers (CustomerName, CustomerType, Email, DeliveryAddressLine1, DeliveryPostalCode, DeliveryCity, PaymentMethod, Bank, ccName, ccIban, ccNumber)
                VALUES (:naam, :type, :email, :address, :zip , :city, :method, :bank, :ccname, :cciban, :ccnumber)");
            $stmt->bindValue(':naam', $naam);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':address', $address);
            $stmt->bindValue(':zip', $zip);
            $stmt->bindValue(':city', $city);
            $stmt->bindValue(':method', $method);
            $stmt->bindValue(':bank', $bank);
            $stmt->bindValue(':ccname', $ccname);
            $stmt->bindValue(':cciban', $cciban);
            $stmt->bindValue(':ccnumber', $ccnumber);
            $stmt->bindValue(':type', $type);

            $stmt->execute();

    } catch (Exception $e) {
        return $e;
    }
}

function RegisterLogin($user, $pass){
    try {
            $pdo = connect();
        $stmt = $pdo->prepare("INSERT INTO clogin (CustomerID, CustomerEmail, CustomerPassword)
                VALUES (:id, :user, :pass)");

            $fetch = GetLastID();
            $id = $fetch->fetch(PDO::FETCH_ASSOC);
            $stmt->bindValue(':id', $id['id']);
            $stmt->bindValue(':user', $user);
            $stmt->bindValue(':pass', $pass);

            $stmt->execute();

    } catch (Exception $e) {
        return $e;
    }
}

function GetLastID(){
    try {
            $pdo = connect();
            $stmt = $pdo->prepare("SELECT MAX(CustomerID) AS id FROM customers");

            $stmt->execute();
            return $stmt;
    } catch (Exception $e) {
        return $e;
    }
}

function Login($user){
    try {
            $pdo = connect();
            $stmt = $pdo->prepare("SELECT CustomerID, CustomerEmail, CustomerPassword FROM clogin WHERE CustomerEmail = :user");
            $stmt->bindValue(':user', $user);

            $stmt->execute();
			return $stmt;
    } catch (Exception $e) {
        return $e;
    }
}

function CreateOrder(){
    var_dump($_SESSION['id']);
    $datum = date("Y/m/d");
    try {
            $pdo = connect();
            $stmt = $pdo->prepare("INSERT INTO orders (CustomerID, OrderDate) VALUES(:id, :datum)");
            $stmt->bindValue(':id', $_SESSION['id']);
            $stmt->bindValue(':datum', $datum);
            $stmt->execute();
            return $stmt;
    } catch (Exception $e) {
        return $e;
    }
}

function GetOrderID(){
    try {
        $pdo = connect();
        $stmt = $pdo->prepare("SELECT MAX(OrderID) AS id FROM orders");
        $stmt->execute();
        return $stmt;
    } catch (Exception $e) {
        return $e;
    }
}

function CreateList($item, $aantal, $category) {
    $stmt = GetOrderID();
    if($row = $stmt->fetch()) {
        $order = $row['id'];
    } else {
        // geef error
    }

    $stmt = getProduct($item, $category);
    if ($row = $stmt->fetch()) { 
        $prijs = $row['prijs'];
    }
    try {                   
            $pdo = connect();
            $stmt = $pdo->prepare("INSERT INTO orderlines( stockitemID, OrderID, UnitPrice, TaxRate, Quantity)
                                    VALUES(:itemid, :order, :price, 21, :quantity)");
            $stmt->bindValue(':itemid', $item);
            $stmt->bindValue(':order', $order);
            $stmt->bindValue(':price', $prijs);
            $stmt->bindValue(':quantity', $aantal);

            $stmt->execute();
            return $stmt;
        
    } catch (Exception $e) {
        return $e;
    }
    
}