<!DOCTYPE html>
<html>
<head>
	<title>payment</title>
    <link rel="stylesheet" href="betalen.css">

	<!-- database -->

	<!--header&navbar-->
	<?php 
        require "../main/meta.php"; 
        require '../main/header.php';
        require '../main/nav.php';
        require '../search/search.php';
    ?>
</head>
<body>


<a href="betalen.php?methode=ideal">    
    <div class="ideal"  style="margin-top: 150px;">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e9/IDEAL_Logo.png" alt="ideal logo" height="100" width="100">
        <p>Pay online via your own bank</p>
    </div>
</a>


</body>
<?php require '../main/footer.php'; ?>
</html>