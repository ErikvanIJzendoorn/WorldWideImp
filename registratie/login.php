<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="account.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!--header&navbar-->
    <?php require "../main/header.php"; ?>
    <?php require "../main/nav.php"; ?>
    <!-- meta -->
    <?php 
        require"../main/meta.html"; 
    ?>
</head>
<body> 
    <div class="container">
    	<form action="validation.php" method="post" class="form">
			<div class="item row">
    			<span class="col-md-2 offset-md-3">Email:</span>
    			<input class="col-md-3" type="email" name="user" placeholder="example@gmail.com" required>
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
                            swal("Login Failed", "The combination wasn't found!", "error");
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