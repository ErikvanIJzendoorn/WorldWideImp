<?php
//Including Database configuration file.
include "db.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
   $Name = $_POST['search'];
//Search query.
   $Query = "SELECT StockItemName, UnitPrice FROM stockitems WHERE StockItemName LIKE '%$Name%'";
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
    <a>
     <!-- Assigning searched result in "Search box" in "search.php" file. -->
       <?php echo "<td>".$Result['StockItemName']."</td>".
                  "<td>"." $".$Result['UnitPrice']."</td><br>"; ?>
    </tr>
    </a>
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->
   <?php
}}
?>
</table>

