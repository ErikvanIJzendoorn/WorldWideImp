<?php 
require '../main/meta.php';
require '../db/connect.php';

if($_GET['login'] == 'y'){
    AttemptLogin();
} else if ($_GET['reg'] == 'guest') {
    regGuest();
} else if ($_GET['reg'] == 'customer') {
    regCustomer();
} 

function AttemptLogin() {
    echo "test";
    if (isset($_POST['user'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $stmt = Login($user);

        if($stmt) {
            echo "1";
            while($row = $stmt->fetch()) {
                echo "5";
                if(password_verify($pass, $row['CustomerPassword'])) {
                    header("Location: ../betalen/index.php");
                    break;
                } else {
                    echo "2";
                }

                $_SESSION['id'] = $row['CustomerID'];
                $_SESSION['email'] = $row['CustomerEmail'];
                $_SESSION['login'] = 'done';
            }
            header("Location: login.php?try=fail&user=$user");
        } else {
            echo '3';
        }
    } else {
        echo "4";
    }
}

function regCustomer() {
    if(isset($_POST)) {
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $zip = $_POST['zip'];
        $city = $_POST['city']; 
        $method = $_POST['paymentMethod'];
        $ccbank = $_POST['bank'];
        $ccname = $_POST['cc-name'];
        $cciban = $_POST['cc-iban'];
        $ccnumber = $_POST['cc-number'];
        $user = $_POST['email'];
        $pass = $_POST['pass'];
        $type = 2;

        $name = $fname . " " . $lname;
        Register($name, $email, $address, $zip, $city, $method, $ccbank, $ccname, $cciban, $ccnumber, $type);

        $hashedpass = password_hash($pass, PASSWORD_BCRYPT);
        RegisterLogin($user, $hashedpass);
        $fetch = GetLastID();
        $_SESSION['id'] = $fetch->fetch(PDO::FETCH_ASSOC);

        header("Location: login.php?login=n");
    }
}

function regGuest(){
    if(isset($_POST)) {
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $zip = $_POST['zip'];
        $city = $_POST['city']; 
        $method = $_POST['paymentMethod'];
        $ccbank = $_POST['bank'];
        $ccname = $_POST['cc-name'];
        $cciban = $_POST['cc-iban'];
        $ccnumber = $_POST['cc-number'];
        $type = 1;

        $_SESSION['gast'] = $_POST;

        $name = $fname . " " . $lname;
        Register($name, $email, $address, $zip, $city, $method, $ccbank, $ccname, $cciban, $ccnumber, $type);

        $fetch = GetLastID();
        $_SESSION['id'] = $fetch->fetch(PDO::FETCH_ASSOC);
        header("Location: ../betalen/index.php?login=n");
    }
}

?>