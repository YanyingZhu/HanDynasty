<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="stylesheet" type="text/css" href="handynasty.css">

    <title>Today Special</title>
    
    <link rel="stylesheet"  href="css/handynasty.css">
 

  </head>

  <body>
  <?php include 'navigate.php' ?>

    <div class="container">

      <form action="addfoodcategories.php" method="post" class="chef-signin">
        <h2 class="form-signin-heading">Add today special</h2>
        
    
        <input list="specialfood" name="todayspecial">
        <datalist id="specialfood">
          <option value="Spicy Volcano Chicken">
           <option value="Dry Pot Pork Intestine">
            <option value="Dry Pepper Squid">
              <option value="Salt pepper spare ribs">
               <option value="Cumin Spare Rib">
                 </datalist>

        <button type="submit" value="Submit" class="block">Submit</button>

      </form>
    </div>
  </body>
</html>