<?php
include 'dbconnection.php';


$orderfood_id = $_GET['orderfood_id'];

$sql = "DELETE FROM orderfood WHERE id = $orderfood_id";

// ID is primary id in customer, and classID is the  primary id in classinfo
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="stylesheet"  href="css/handynasty.css">
    <title>Delete Reservation</title>

    

  </head>

  <body>
    <?php include 'navigate.php' ?> 
    <div class="delete">

    <?php
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $conn->close();
    ?>
    </div>
  </body>
</html>