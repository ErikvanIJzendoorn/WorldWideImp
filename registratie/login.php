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
    <?php require"../main/meta.html"; ?>
</head>
<body> 
    <div class="container">
    	<form action="validation.php" method="post" class="form">
			<div class="item row">
    			<span class="col-md-2 offset-md-3">Gebruikersnaam:</span>
    			<input class="col-md-3" type="email" name="user" placeholder="example@gmail.com" required>
    		</div>
    		<div class="item row">
    			<span class="col-md-2 offset-md-3">Wachtwoord:</span>
    			<input class="col-md-3" type="password" name="pass" placeholder="example123@" required>
    		</div>
    		<div class="item row">
    			<a class="col-md-1 offset-md-5 btn btn-primary" href="registratie.php">Registreren</a>
    			<button class="col-md-1 offset-md-1 btn btn-primary" type="submit">Inloggen</button>
    		</div>
            <div class="item row">
                <a class="col-md-1 offset-md-3 btn btn-link" href="gast.php">Doorgaan als gast</a>
            </div>
    	</form>
    </div>


    <?php 
    	require '../main/footer.php';
    ?>
</body>
</html>