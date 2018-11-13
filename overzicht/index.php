<!DOCTYPE html>
<html>
<head>
	<title>Productpagina</title>
	<meta charset="UTF-8">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- CSS style sheet -->
  <link rel="stylesheet" type="text/css" href="style.css">
  <!-- ROBOTO font -->
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <!-- FONT AWESOME -->   
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous"> 
</head>
<body>
	<div class="jumbotron wrapper">
		<img src="WWI-logo.png" id="logo-img">
    <div class="fas fa-shopping-cart cart">
    </div>
    <div>
      <a href="#" class="log-in">Inloggen</a>  
    </div>
	</div>
    <div class="picture1">
       <img src="https://via.placeholder.com/300" alt="Productimg">
    </div>
    <div class="product-description">
        <p>
        <!-- Productnaam -->
        <?=$naamCategorie; ?>
        </p>
        <br>
        <p class="product-price">
        <!-- Productprijs -->
        <?="€" . $prijsCategorie; ?>
        </p>
        <div id="bestelamnt">
            <input type="number" name="amount" value="1">
        </div> 
    </div>
</body>
   
    <?php
    for($picture1 = 0; $picture1 <29; $picture1++){
        print('<div class="picture1"><img src="https://via.placeholder.com/300" alt="Productimg"></div>');
    }
    ?>
