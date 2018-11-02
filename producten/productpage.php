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

  <div class="navbar navbar-nav ml-auto" id="topNavbar">
		<a href="#" class="navbar-item">Category1</a>
		<a href="#" class="navbar-item">Category2</a>
    <a href="#" class="navbar-item">Category3</a>
    <a href="#" class="navbar-item">Category4</a>
    <a href="#" class="navbar-item">Category5</a>
    <a href="#" class="navbar-item">Category6</a>
    <a href="#" class="navbar-item">Category7</a>
    <a href="#" class="navbar-item">Category8</a>
    <a href="#" class="navbar-item">Category9</a>
  <div class="fas fa-search search"></div>
	</div>

  
  <div class="content">
    <div class="product-name">
      <p>
        Product.name
      </p>
    </div>
    <div class="picture">
      <img src="#" />
    </div>
    <div class="product-description">
      <p>
       product.category
      </p>
      <br>
      <p>
        product.description 
      </p>
      <p class="product-price">
        €{{product.price}}
      </p>
      <div id="bestelamnt">
        <input type="number" name="amount" value="1">
      </div> 
      <p id="available">
        availability.number
      </p>
      <button id="bestelbtn">
        Bestel
      </button>
    </div>
      
  </div>
<div class="try"></div>

<script src="controller.js"></script>
</body>
</html> 