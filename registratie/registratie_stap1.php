<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
  <!-- database connection-->
  <?php
  require '../db/connect.php'
  ?>
  
  <!--registration form -->
  <form action="validation.php" method="post">
        First name <input type="text" name="firstname" placeholder="firstname"/><br>
        Last name <input type="text" name="lastname" placeholder="last name"/><br>
        Hometown <input type="text" name="hometown" placeholder="hometown"/><br>
        Postal code <input type="text" name="postalcode" placeholder="postalcode" /><br>
        Street name and house number <input type="text" name="streetname" placeholder="address"><br>
        Phone number <input type="number" name="phone" placeholder='phonenumber'/><br>
        Gender : <select name="gender">
            <option>Male</option>
            <option>Female</option>
        </select>
        <input type='submit' name="submit" value="submit">
    </form>
</body>
</html>