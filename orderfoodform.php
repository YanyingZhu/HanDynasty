<?php
include 'dbconnection.php';

$sql = "SELECT ID, todayspecial FROM foodcategories";
$foodcategories = $conn->query($sql);
//Check if a beer_id was supplied in the URL Query Parameter
if (isset($_GET['id'])) {
  $orderfood_id = $_GET['id'];
  //Query DB for details on that customer
  $orderfoodSQL = "SELECT * FROM orderfood where id = $orderfood_id";
  // ID is the name in customer table for id 
  $orderfood =  $conn->query($orderfoodSQL)->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="registrator.css">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="stylesheet"  href="css/handynasty.css">
    <title>Order Food</title>

    

  </head>

  <body>
    <?php include 'navigate.php' ?>
    <div class="containers">
      <form action="addorderfood.php" method="post" class="guest-signin">
        <h2 class="form-signin-heading">Online reservation</h2>
        <?php if(isset($orderfood_id)) echo "<input type='hidden' name='orderfood_id' value=" . $orderfood_id ." >"; ?>

          <div class="guestform">
              <li><label for="foodID">Today Special:</label></li>
              <select name="foodID" id="foodID">
                <?php
                if ($foodcategories->num_rows > 0) {
                    // output data of each row
                    while($row = $foodcategories->fetch_assoc()) {
                        echo "<option value='" . $row["ID"] ."'";
                        if (isset($orderfood) and  $orderfood['foodID'] == $row["ID"]) echo "selected";
                        echo ">" . $row["todayspecial"] . "</option>";
                    }
                }
                ?>
              </select>
          </div>


          <div class="guestform">
              <li><label for="firstname">Firstname:</label></li>
              <input type="name" name="firstname" value="John" maxlength="10" required  class="form-control" <?php if (isset($orderfood['firstname'])) echo "value='" . $orderfood['firstname'] . "'"; ?> />
          </div>

          <div class="guestform">
            <li><label for="phone">Tel:</label></li>
            <input type="tel" name="phone" value maxlength="10" required placeholder="Enter a valid phone number" class="form-control" <?php if (isset($orderfood['phone'])) echo "value='" . $orderfood['phone'] . "'"; ?> />
          </div>

          <div class="guestform">
           <li> <label for="amount">How many people ?</label></li>
            <input type="number" min="5" max="20" name="amount" value=""  class="form-control" <?php if (isset($orderfood['amount'])) echo "value='" . $orderfood['amount'] . "'"; ?> />
          </div>

          <div class="submit-c">
              <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
          </div>
      </form>
    </div>
  </body>
</html>