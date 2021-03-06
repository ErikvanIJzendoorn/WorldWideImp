<?php 
function connect(){
	$db ="mysql:host=localhost;dbname=wideworldimporters;port=3306";
	$user = "wwi";
	$pass = "test";
	$pdo = new PDO($db, $user, $pass);
	return $pdo;
}

// Get a single product from the DB
if(!function_exists("getProduct")){
    function getProduct($productID) {
            try{
                $pdo = connect();
                $stmt = $pdo->prepare("
                        SELECT StockItemName naam, SG.StockGroupName categorie, CustomFields herkomst, PackageTypeName verpakking, ColorName kleur, UnitPrice prijs, TaxRate btw, QuantityOnHand voorraad, MarketingComments comments, Tags tags, TypicalWeightPerUnit weight, S.StockItemID itemID, SG.StockGroupID categorieID, C.ColorID kleurID, P.PackageTypeID verpakkingID FROM StockItems S LEFT JOIN Colors C ON S.ColorID = C.ColorID LEFT JOIN PackageTypes P ON S.UnitPackageID = P.PackageTypeID LEFT JOIN StockItemHoldings H ON S.StockItemID = H.StockItemID LEFT JOIN StockItemStockGroups SS ON S.StockItemID = SS.StockItemID LEFT JOIN StockGroups SG ON SS.StockGroupID = SG.StockGroupID WHERE S.StockItemID = ?
                ");

                $stmt->execute(array($productID));
                return $stmt;
            }catch (PDOException $e)
        {
            return $e;
        }
    }
}

function getCategoryFromProduct($productID) {
    try {
            $pdo = connect();
            $stmt = $pdo->prepare("
                SELECT StockGroupID FROM StockGroups WHERE StockItemID = ?");

            $stmt->execute(array($productID));
            return $stmt;
    }catch (PDOException $e) {
        return $e;
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
                    GROUP BY SG.StockGroupID
        ORDER BY SG.StockGroupName ASC");

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
            $stmt = $pdo->prepare("SELECT SI.StockItemID id, StockItemName naam, UnitPrice prijs, QuantityOnHand voorraad FROM StockItems SI 
                JOIN StockItemStockGroups SISG ON SI.StockItemID = SISG.StockItemID 
                JOIN stockitemholdings SH ON SI.StockItemID = SH.StockItemID
                WHERE StockGroupID = ?");
            
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
        $stmt = $pdo->prepare("INSERT INTO customers (CustomerName, Type, Email, DeliveryAddressLine1, DeliveryPostalCode, City, PaymentMethod, Bank, ccName, ccIban, ccNumber)
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

function CreateList($item, $aantal) {
    $stmt = GetOrderID();
    if($row = $stmt->fetch()) {
        $order = $row['id'];
    } else {
        // geef error
    }

    $stmt = getProduct($item);
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

function updateSupply($aantal, $id) {
    try {                  
        $pdo = connect();
        $stmt = $pdo->prepare("UPDATE stockitemholdings SET QuantityOnHand = QuantityOnHand - :aantal WHERE StockItemID = :id");
        $stmt->bindValue(':aantal', $aantal);
        $stmt->bindValue(':id', $id);

        $stmt->execute();
        return $stmt;
    } catch (Exception $e) {
        return $e;
    }
}

function getCustomer($email) {
    try {                  
        $pdo = connect();
        $stmt = $pdo->prepare("SELECT CustomerName naam, Email email, DeliveryAddressLine1 adres, DeliveryPostalCode zip, City, city FROM customers WHERE Email = :email");
        $stmt->bindValue(':email', $email);

        $stmt->execute();
        return $stmt;
    } catch (Exception $e) {
        return $e;
    }
}