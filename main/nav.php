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
            <a href="../overzicht/productpage.php?category=<?=$id?>&pageNumber=0&sort=0&productAmount=30&filter=0&filterValue=0" class="navbar-item"><?php print($cat[1]); ?></a>        
        <?php
            }
        ?>
    </div> 
</nav>

<script type="text/javascript" src="../main/stickyController.js"></script>
