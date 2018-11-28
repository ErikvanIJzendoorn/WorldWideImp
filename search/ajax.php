<?php
//Including Database configuration file.
include "db.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
   $name = $_POST['search'];
//Search query.
   $Query = "SELECT DISTINCT StockItemName, UnitPrice, StockItemID, SG.StockGroupID FROM stockitems SI JOIN stockitemstockgroups SISG USING(StockItemID) JOIN stockgroups SG ON SISG.StockGroupID=SG.StockGroupID WHERE StockItemName LIKE '%$name%'";
//Query execution
   $ExecQuery = MySQLi_query($con, $Query);
//Creating unordered list to display result.
   echo 
   '<table>';
   //Fetching result from database.
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
?>
   <!--Calling javascript function named as "fill" found in "script.js" file. By passing fetched result as parameter. -->
    <tr onclick='fill("<?php echo $Result['StockItemName']; ?>")'>
      
     <!-- Assigning searched result in "Search box" in "search.php" file. -->
       <?php echo 
      "
      <td>
      
        <a href='../product/index.php?product=" . 
        $Result['StockItemID'] . "&category=".$Result['StockGroupID'] . "'>
        <div class='search-span'>";
        echo  "<span>".$Result['StockItemName']."</span>"; 
        echo  "<span class='search-p-price'>"."$".$Result['UnitPrice']."</span>";
        echo "
        </div> 
        </a>
      </td>

      ";
         ?>
    </tr>
   
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->
   <?php
}}
?>
</table>

