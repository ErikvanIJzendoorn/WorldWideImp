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
    //$_SESSION['attempts'] = 0;
    if($_SESSION['attempts'] <= 5) {
        // als je niet over het limiet heen bent
        
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $stmt = Login($user);
        if($row = $stmt->fetch()) {
            // als username bestaat
            
            $stmt = Login($user);
            while($row = $stmt->fetch()) {
                if(password_verify($pass, $row['CustomerPassword'])){
                    // als wachtwoord klopt
                    $_SESSION['id'] = $row['CustomerID'];
                    $_SESSION['email'] = $row['CustomerEmail'];
                    $_SESSION['login'] = 'done';
                    $_POST = null;
                    header("Location: ../betalen/index.php");
                } else {
                    fail("wrong");
                }
            }
        }else {
            // als username niet bestaat
            fail("wrong");
        }
    } else if($_SESSION['attempts'] == 20) {
        fail("denied");
    } else {
        fail("no");
    }
}

function fail($type)
{
    if($type == "wrong") {
        $_SESSION['attempts'] = $_SESSION['attempts'] + 1;
        
        if($_SESSION['attempts'] <= 5) {
            header("Location: login.php?try=fail");
        } else {
            $_SESSION['attemtps'] = 20;
            fail("denied");
        }
    } else if($type == "denied") {
        $_SESSION['current'] = date("H:i:s");
        $_SESSION['allowed'] = date("H:i:s", strtotime(date("H:i:s")." +10 seconds"));
        $_SESSION['attempts'] = 19;
        header("Location: login.php?login=no");
        echo "no 1 " . $_SESSION['attempts'];
    } else {
        
        if($_SESSION['attempts'] == 19) {
            $_SESSION['current'] = date("H:i:s");
            
            if($_SESSION['current'] > $_SESSION['allowed']) {
                $_SESSION['attempts'] = 0;
                AttemptLogin();
            } else {
                header("Location: login.php?login=no");
                echo "no 2 " . $_SESSION['attempts'];
                echo "<br> " . $_SESSION['current'] . " " . $_SESSION['allowed'];
            }
        } else {
            //header("Location: login.php?login=no");
            echo "no 3 " . $_SESSION['attempts'];
        }
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