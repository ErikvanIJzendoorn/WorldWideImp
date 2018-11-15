<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="landing.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<!-- database -->
	<?php require "../db/connect.php" ?>

	<!--header&navbar-->
	<?php require "../main/header.php"; ?>
</head>
<body>
	<form action="validate.php?method=ideal" method="post">
		
		<select name="" id="">
			<option value="">Rabobank</option>
			<option value="">ING</option>
			<option value="">Knab</option>
			<option value="">SNS</option>
			<option value="">ABN Amro</option>
		</select><br>

		<button type="submit">Bevestigen</button>
	</form>

</body>
</html> 