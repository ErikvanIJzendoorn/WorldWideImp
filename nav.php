<nav>
    <div class="jumbotron wrapper">
        <img src="WWI-logo.png" id="logo-img">
        <div class="fas fa-shopping-cart cart">
        </div>
        <div class="fas fa-sign-in-alt cart">
        </div>
    </div>

    <div class="navbar navbar-nav ml-auto" id="topNavbar">
        <?php 
        require '../db/connect.php';
            $stmt = getCategory();
            while($row = $stmt->fetch()) {
                $id = $row['id'];
                $naam = $row['naam'];
                $cat = array($id, $naam);
        ?>
            <a href="#" class="navbar-item"><?php print($cat[1]); ?></a>        
        <?php
            }
        ?>
    </div> 
</nav>