<?php
//Including Database configuration file.
include "db.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
   $Name = $_POST['search'];
//Search query.
   $Query = "SELECT StockItemName, UnitPrice, StockItemID FROM stockitems  WHERE StockItemName LIKE '%$Name%'";


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
      <a href=""></a>

     <!-- Assigning searched result in "Search box" in "search.php" file. -->
       <?php 

       echo 
      "
        <td>
        <a href='../product/index.php?product=" . 
        $Result['StockItemID'] . "'>" ;

        echo  $Result['StockItemName']; 
        echo  $Result['UnitPrice'];
        echo "
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

