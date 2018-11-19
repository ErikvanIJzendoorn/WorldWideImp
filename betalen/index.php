<!DOCTYPE html>
<html>
<head>
	<title>Betaalpagina</title>
        <link rel="stylesheet" href="betalen.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<!-- database -->
	<?php require "../db/connect.php" ?>

	<!--header&navbar-->
	<?php require "../main/header.php"; ?>
</head>
<body>
    <a href="betalen.php?methode=ideal">    
        <div class="ideal">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e9/IDEAL_Logo.png" alt="ideal logo" height="100" width="100">
            <p>Online betalen via uw eigen bank</p>
        </div>
    </a>
</body>
</html>

<!-- 


Box
IDEAL

dropdown
- Rabonbank
- ING
- etc...

Bankrekeningnummer
Pasnummer



Kortingscode???





 -->