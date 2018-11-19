<?php 
require '../db/connect.php';



function AttemptLogin() {
    if (isset($_POST['user']) && isset($_POST['pass'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $stmt = Login($user, $pass);

        if($row = $stmt->fetch()) {
            header("Location: ../betalen/index.php");
        } else {
            echo "Combinatie niet gevonden!";
        }
    }
}
AttemptLogin();

?>