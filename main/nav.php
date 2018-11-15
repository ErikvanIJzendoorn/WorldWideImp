<nav>
    <div class="navbar navbar-nav ml-auto" id="topNavbar">
        <?php 
        require '../db/connect.php';
            $stmt = getCategory();
            while($row = $stmt->fetch()) {
                $id = $row['id'];
                $naam = $row['naam'];
                $cat = array($id, $naam);
        ?>
            <a href="../overzicht/productpage.php?category=<?=$id?>" class="navbar-item"><?php print($cat[1]); ?></a>        
        <?php
            }
        ?>
    </div> 
</nav>