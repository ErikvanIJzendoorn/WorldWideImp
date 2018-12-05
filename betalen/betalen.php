<!DOCTYPE html>
<html>
<head>
	<title>payment ideal</title>
	<link rel="stylesheet" href="betalen.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<?php 
        require "../main/meta.php"; 
        require '../main/header.php';
        require '../main/nav.php';
        require '../search/search.php';
    ?>
</head>
<body>
    <div class="container" style="margin-top: 170px;">
    	<div class="col-md-6 offset-md-4">
    		<p class="col-md-9">Welcome to IDEAL, WE ARE LEGIT :)</p>
    		<a class="btn btn-primary col-md-3 offset-md-1" href="betalen.php?paid=y">Pay</a>
    	</div>
    </div>
</body>

<?php require '../main/footer.php'; ?>


<?php 

	if(isset($_GET['paid'])) {
		if($_GET['paid'] == 'y') {
		?>
			<script type="text/javascript">
				window.onload = function() {
				    swal("Are you sure you want to pay us?", {
					  buttons: {
					    cancel: "Cancel!",
					    catch: {
					      text: "Pay",
					      value: "catch",
					    }
					  },
					})
					.then((value) => {
					  switch (value) {
					 
					    case "catch":
					      swal({
							  title: "Payment succesfull",
							  text: "Your payment was received",
							  icon: "success",
							  button: true,
							}).then((value) => window.location.replace("order.php?paid=y"));
					      break;
					 
					    default:
					      swal("Payment cancelled");
					  }
					});
				}
			</script>
		<?php
	}
	}

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html> 