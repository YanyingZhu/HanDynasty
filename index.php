<?php
include 'dbconnection.php';
$Page = intval($_GET['P']);
$todaySpecial = intval($_GET['todaySpecial']);
$searchWhere = 'orderfood.foodID > 0';
if($todaySpecial >0 ){
    $searchWhere = 'orderfood.foodID = '.$todaySpecial;
}
$Page = $Page<=0?1:$Page;
$PageNum = 4;
$startRow = ($Page-1)*$PageNum;
$sql = "SELECT orderfood.id as orderfood_id, firstname, phone, amount,foodcategories.ID as foodcategories_ID, todayspecial
        FROM orderfood JOIN foodcategories ON orderfood.foodID = foodcategories.ID 
        WHERE $searchWhere 
        ORDER BY orderfood.amount DESC
        LIMIT $startRow,$PageNum";
$result = $conn->query($sql);
//page_url
$back_url = '/index.php?P='.($Page-1);
$back_url .= $todaySpecial > 0?$back_url.'&todaySpecial='.$todaySpecial:$back_url;
$next_url = '/index.php?P='.($Page+1);
$next_url .= $todaySpecial > 0?$next_url.'&todaySpecial='.$todaySpecial:$next_url;
//all foodcategories
$sql = "SELECT * FROM foodcategories";
$cateGories = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="stylesheet"  href="css/handynasty.css">
    <title>Han Dynasty</title>
    <style>
         a{
            text-decoration: none;
            color:#FFF;
        }
         a:hover{
            text-decoration: underline;
        }
        table.foodimg{
    width:100%;
    border:1px solid #fff;
    color:#FFF;
    padding-left:20px;
}
thead td{
    font-weight: bold;
    font-size: 20px;
    padding-bottom:20px;
}
tbody td{
    padding-bottom:10px;
}
.page-div,.page-div *{
    padding-top:10px;
    text-align: center;
    color:#FFF;
}
.page-div a{
    padding-right:20px;
}
    </style>
    
  </head>
  <body>
   <?php include 'navigate.php' ?>
    <div class="formpart">
      <p>Today Special Introduction</p>
      <div class="foodimg">
        <div class="row">
            <a href=""><img src="image/porkintestine.jpg"></a>
            <a href=""><img src="image/saltsquid.jpg"></a>
            <a href=""><img src="image/sparerib.jpg"></a>
            <a href=""><img src="image/spicychicken.jpg"></a>
        </div>
      </div>
      <div style="clear:both;"></div> <!--clear float css-->
      <p style="margin-bottom:0px;">Resveration People</p>
      <div style="padding-left:20px;padding-bottom:20px;">
          <form action="">
              <select name="todaySpecial" style="width:200px;height:30px;">
                  <option value="0">ALL</option>
                  <?php
                    foreach($cateGories as $k=>$v){
                      echo "<option value=".$v["ID"].">".$v["todayspecial"]."</option>";
                    }
                  ?>
              </select>
              <input type="submit" value="Search" style="height:50px;">
           </form>
      </div>
        <table class="foodimg">
            <thead>
                <tr>
                    <td>FirstNname</td>
                    <td>Phone</td>
                    <td>TodaySpecial</td>
                    <td>Amount</td>
                    <td>Handle</td>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                // output data of each row
                $rowString = '';
                while($row = $result->fetch_assoc()) {
                    $rowString .= '<tr>';
                    $rowString .= '<td>'.$row['firstname'].'</td>';
                    $rowString .= '<td>'.$row['phone'].'</td>';
                    $rowString .= '<td>'.$row['todayspecial'].'</td>';
                    $rowString .= '<td>'.$row['amount'].'</td>';
                    $rowString .= '<td>'."<a target=blank href=deleteorder.php?orderfood_id=" . $row['orderfood_id']  ."> Delete</a> | ";
                    $rowString .= "<a target=blank href=orderfoodform.php?orderfood_id=" . $row['orderfood_id']  ."> Update</a>".'</td>';
                    $rowString .= "</tr>";
                }
                echo $rowString;
            }
            ?>
            </tbody>
        </table>
        <div class="page-div">
            <?php
            if($Page > 1){
                echo "<a href=$back_url>"."Before</a>";
            }
            if($result->num_rows >= $PageNum){
                echo "<a href=$next_url>"."Next</a>";
            }
            echo "<span>The $Page Page</span>";
            ?>
        </div>
    </div>

    <!--<div class="formlist">
      <?php
/*      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo $row['firstname'] . " | " . $row['phone'] . " | " . $row['amount'] .
              " | " . $row['todayspecial'] .  

               " | <a href=deleteorder.php?orderfood_id=" . $row['orderfood_id']  ."> delete</a>" .
               " | <a href=orderfoodForm.php?orderfood_id=" . $row['orderfood_id']  ."> update</a>" . "<br>";
          }
      }
      */?>
    </div>-->
  </body>
</html>