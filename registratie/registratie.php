<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
    <!-- database connection-->
    <!--header&navbar-->
    <?php require "../main/header.php"; ?>
    <?php require "../main/nav.php"; ?>
    <!-- meta -->
    <?php require"../main/meta.html"; ?>

    <!--registration form -->
    <form class="container" style="margin-top: 100px; margin-bottom: -80px;" action="register.php" method="post">
        <div class="form-row">
            <div class="form-group col-md-4 offset-md-1">
                <label for="inputEmail4">Emailadres</label>
                <input type="email" name="user" class="form-control" placeholder="example@test.nl" required>
            </div>

            <div class="form-group col-md-4 offset-md-1">
                <label for="inputEmail4">Voornaam</label>
                <input type="text" name="voornaam" class="form-control" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4 offset-md-1">
                <label for="inputPassword4">Wachtwoord</label>
                <input type="password" name="pass" class="form-control" placeholder="example123@" required>
            </div>

            <div class="form-group col-md-4 offset-md-1">
                <label for="inputEmail4">Achternaam</label>
                <input type="text" name="achternaam" class="form-control" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4 offset-md-6">
                <label for="inputAddress">Adres</label>
                <input type="text" name="adres" class="form-control" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2 offset-md-6">
                <label for="inputCity">Stad</label>
                <input type="text" name="plaats" class="form-control" required>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Postcode</label>
                <input type="text" name="postcode" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary offset-md-9 col-md-1">Verzenden</button>
    </form>

    <?php 
        require '../main/footer.php';
    ?>
</body>
</html>