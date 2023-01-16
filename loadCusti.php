<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:accLogin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Loader</title>
    <link rel="stylesheet" href="loadStyle.css" />
  </head>
  <body>
    <?php
    	require_once "navigationBar.php";
    ?>
    <h2>Customer Details</h2>
    <form action="loadCustomer.php" method="post">
      <div>
        <label for="cus_name">Full Name</label>
        <input type="text" name="cus_name" required />
      </div>
      <div>
        <label for="cell">Cellphone</label>
        <input type="tel" name="cell" required />
      </div>
      <div>
        <label for="address">Home Address</label>
        <textarea name="address" id="" cols="30" rows="6"></textarea>
      </div>
      <div>
        <input type="submit" value="Upload" id="but" />
      </div>
    </form>
  </body>
</html>
