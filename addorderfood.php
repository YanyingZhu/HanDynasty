<?php
include 'dbconnection.php';

$foodID = $_POST['foodID'];
$firstname = $_POST['firstname'];
$phone = $_POST['phone'];
$amount = $_POST['amount'];

//Check if a beer_id was provided if so, we're updating a beer, otherwise we're inserting

if (isset($_POST['orderfood_id'])) 
{
  $orderfood_id = $_POST['orderfood_id']; 

  $sql =  "UPDATE orderfood SET firstname ='$firstname', phone = '$phone', amount = '$amount'
  WHERE id = $orderfood_id"; 
} else {
  $sql = "INSERT INTO orderfood (foodID, firstname, phone, amount)
  VALUES ('$foodID','$firstname','$phone','$amount')";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="stylesheet"  href="css/handynasty.css">
    <title> Reservation update</title>



  </head>

  <body>
    <?php include 'navigate.php' ?>
    <div class="containerform">
      <div class="starter-template">

      <?php
      if ($conn->query($sql) === TRUE) {
          echo "<h2 class='guest-signin-heading''>Your reservation created successfully</h2> <br>";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $conn->close();
       ?>
      
       <a>
      Today:<?php echo  date("Y-m-d") . date("l")."<br>";?><br>
      Firstname: <?php echo $firstname ?><br>
      Tel: <?php echo $phone ?><br>
      Number of people: <?php echo $amount ?><br></a>
      <h3> [ If you have any questions, please contact <a class="tel" href=""> (215)508-2066  </a> ] </h3>

      <h4> <a href="https://www.google.com/maps/place/Han+Dynasty/@40.0253651,-75.2239099,19z/data=!4m12!1m6!3m5!1s0x89c6b8957ab7c35d:0x826e45efdcb76956!2sHan+Dynasty!8m2!3d40.0253927!4d-75.223868!3m4!1s0x89c6b8957ab7c35d:0x826e45efdcb76956!8m2!3d40.0253927!4d-75.223868"> Address: 4356 Main St, Philadelphia, PA 19127</a></h4>
      </div>
      
      <div id="map" class="map"> 

<a href="https://www.google.com/maps/place/Philadelphia+Manuyunk+4356+Main+Street/">
<img width="500" height="300" src="http://maps.googleapis.com/maps/api/staticmap?center=Philadelphia+4356+Main+Street&zoom=18&scale=1&size=500x300&maptype=hybrid&format=jpg&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:1%7CPhialdelphia+4356+Main+Street&markers=size:mid%7Ccolor:0xff0000%7Clabel:1%7CPhiladelphia+4356+Main+Street" alt="Google Map of Philadelphia 4356 Main Street"></a>
   
    </div>

    </div>
  </body>
</html>
