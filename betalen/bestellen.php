<?php 

require '../db/connect.php';
session_start();

function order(){
	$items = $_SESSION['cart'];
	var_dump($_SESSION);
	CreateOrder();
	foreach ($items as $key => $value) {
		CreateList($value['id'], $value['aantal'], $value['category']);
		updateSupply($value['aantal'], $value['id']);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Betaalopties</title>
	<link rel="stylesheet" href="betalen.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!--header&navbar-->
	<?php require "../main/header.php"; ?>
</head>
<body>
    <div class="container">
    	<div class="col-md-6 offset-md-4">
    		<p class="col-md-9">Welcome to IDEAL, WE ARE LEGIT :)</p>
    		<a class="btn btn-primary col-md-3 offset-md-1" href="betalen.php?paid=y">Pay</a>
    	</div>
    </div>
</body>

<?php 

	if(isset($_GET['paid'])) {
		if($_GET['paid'] == 'y') {
			order();
			?>
				<script type="text/javascript">
					window.onload = function() {
					    swal("Succesfully sent in the order").then((value) => window.location.replace("../winkelwagen/cart.php?func=empty"));
					}
				</script>
			<?php
		}
	}
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html> 