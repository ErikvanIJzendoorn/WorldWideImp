<?php 

require '../db/connect.php';
require '../main/meta.php';

function order(){
	$items = $_SESSION['cart'];
	CreateOrder();
	foreach ($items as $key => $value) {
		CreateList($value['id'], $value['aantal']);
		updateSupply($value['aantal'], $value['id']);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Payment ideal</title>
	<link rel="stylesheet" href="betalen.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!--header&navbar-->
	<?php require "../main/header.php"; ?>
</head>


<?php 

	if(isset($_GET['paid'])) {
		if($_GET['paid'] == 'y') {
			order();
			?>
				<script type="text/javascript">
					window.onload = function() {
					    swal("Succesfully sent in the order").then((value) => window.location.replace("../winkelwagen/cart.php?func=empty&order=y"));
					}
				</script>
			<?php
		}
	}
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html> 