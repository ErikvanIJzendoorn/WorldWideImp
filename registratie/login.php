<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="account.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
        <!--header&navbar-->
    <?php require '../main/meta.php'; ?>

    <?php 
        if(isset($_GET['func']) == 'logout') {
            $_SESSION['login'] = null;
            $_SESSION['id'] = null;
            $_SESSION['attempts'] = null;
            $_SESSION['email'] = null;
        } else if (isset($_SESSION['login']) == 'done') {
            header("Location: ../betalen/overzicht.php");
        } else if (isset($_GET['login']) == 'no'){
            ?>
                <script type="text/javascript">
                    window.onload = function() {
                        swal("Login Failed", "You made to many attempts Wait untill: <?=$_SESSION['allowed'];?>", "error");
                    }
                </script>
            <?php
        } 

        if(isset($_SESSION['reg_type']) && $_SESSION['reg_type'] == 'cust'){
            ?>
                <script type="text/javascript">
                    window.onload = function() {
                        swal("You have registered succesfully");
                    }
                </script>
            <?php
            $_SESSION['reg_type'] = null;
        } 
    ?>
    
    <?php require "../main/header.php"; ?>
    <?php require "../main/nav.php"; ?>
    <!-- meta -->
</head>
<body> 
    <div class="container">
        <div class="header-name"><h1>Login</h1></div>
    	<form action="validation.php?login=y" method="post" class="form">
			<div class="item row">
    			<span class="col-md-2 offset-md-3">Email:</span>
    			<?php 
                    if(isset($_GET['try']) && isset($_GET['user'])) {
                        ?>
                            <input class="col-md-3" type="email" name="user" value="<?=$_GET['user'];?>" required>
                        <?php
                    } else {
                        ?>
                            <input class="col-md-3" type="email" name="user" placeholder="example@gmail.com" required>
                        <?php
                    }
                ?>
    		</div>
    		<div class="item row">
    			<span class="col-md-2 offset-md-3">Password:</span>
    			<input class="col-md-3" type="password" name="pass" placeholder="example123@" required>
    		</div>
    		<div class="item row">
    			<a class="col-md-1 offset-md-5 btn btn-primary" href="registratie.php">Register</a>
    			<button class="col-md-1 offset-md-1 btn btn-primary" type="submit">Login</button>
    		</div>
            <div class="item row">
                <a class="col-md-1 offset-md-3 btn btn-link" href="gast.php">Continue as guest</a>
            </div>
    	</form>
    </div>

    <?php 
    	require '../main/footer.php';
        if (isset($_GET['try'])) {
            if($_GET['try'] == 'fail') {
                ?>
                    <script type="text/javascript">
                        window.onload = function() {
                            swal("Login Failed", "The combination wasn't found! You have  <?php $i = 5; echo $i - $_SESSION['attempts'];?> attempts left!", "error");
                        }
                    </script>
                <?php
            } else {

            }
        }
    ?>
</body>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>