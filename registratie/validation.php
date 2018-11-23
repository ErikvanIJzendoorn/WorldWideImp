<?php 
require '../db/connect.php';



function AttemptLogin() {
    if (isset($_POST['user'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $stmt = Login($user);

        while($row = $stmt->fetch()) {
            if(password_verify($pass, $row['CustomerPassword'])) {
                 header("Location: ../betalen/index.php");
            } else {
                header("Location: login.php?try=fail&user=$user");
            }
        }
    }
}
AttemptLogin();

?>