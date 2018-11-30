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
    if(!isset($_SESSION['attempts'])) {
        $attempts = 0;
    } else {
        $attempts = $_SESSION['attempts'];
    }

    if(!isset($login)) {
        $login = TRUE;
    }

    if(!isset($allowed)) {
        $allowed = date("H:i:s");
    } else {
        $allowed = $_SESSION['allowed'];
    }
    
    $current = date("H:i:s");
    
    if (isset($_POST['user'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $stmt = Login($user);

        if($attempts < 5 || ($current >= $allowed)) {
            if(($row = $stmt->fetch()) && $login) {
                $stmt = Login($user);
                echo "1.1";
                while($row = $stmt->fetch()) {
                    echo "1.2";
                    if(password_verify($pass, $row['CustomerPassword'])) {
                        $_SESSION['attempts'] = $attempts;
                        $_SESSION['id'] = $row['CustomerID'];
                        $_SESSION['email'] = $row['CustomerEmail'];
                        $_SESSION['login'] = 'done';
                        $_POST = null;
                        header("Location: ../betalen/index.php");
                    } else {
                       if($attempts < 5) {
                            $attempts++;
                            $_SESSION['attempts'] = $attempts;
                            echo "no";
                            header("Location: login.php?try=fail&user=$user");
                        } else if ($attempts > 5 && ($current > $allowed)) {
                            $attempts = 0;
                            $_SESSION['attempts'] = $attempts;
                            $_SESSION['current'] = null;
                            $_SESSION['allowed'] = null;
                            $login = TRUE;
                            echo "fail";
                        } else if ($current < $allowed) {
                            echo "1";
                            header("Location: login.php?login=no");
                        } else {
                            $_SESSION['wait_time'] = $current - $allowed;
                            $login = FALSE;
                            $_SESSION['current'] = date("H:i:s");
                            $_SESSION['allowed'] = date("H:i:s",strtotime(date("H:i:s")." +10 minutes"));
                            echo "2";
                            header("Location: login.php?login=no");
                        }
                    }
                    echo "5";
                }
            } else {
                $attempts++;
                $_SESSION['attempts'] = $attempts;
                echo "fail 2";
                header("Location: login.php?try=fail&user=$user");
            }
        } else {
            echo "3" . "<br>";
            echo $current . "<br>";
            echo $allowed . "<br>";
            echo $attempts . "<br>";
            header("Location: login.php?login=no");
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