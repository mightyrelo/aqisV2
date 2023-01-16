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
    <title>Product Loader</title>
    <link rel="stylesheet" href="loadStyle.css" />
   
  </head>
  <body>
      <?php
    	require_once "navigationBar.php";
    ?>
    <h2
    <h2>Product Details</h2>
    <form action="loadProduct.php" method="post">
      <div>
        <label for="pro_name">Product Name</label>
        <input type="text" name="pro_name" required />
      </div>
      <div>
        <label for="desc">Description</label>
        <textarea name="desc" id="" cols="30" rows="6"></textarea>
      </div>
      <div>
        <label for="trade">Trade Price</label>
        <input
          type="number"
          name="trade"
          min="0"
          max="100000"
          step="0.0100"
          placeholder="0.02"
          required
        />
      </div>
      <div>
        <label for="retail">Retail Price</label>
        <input
          type="number"
          name="retail"
          min="0"
          max="100000"
          step="0.01"
          placeholder="0.02"
          required
        />
      </div>

      <div>
        <input type="submit" value="Upload" id="but" />
      </div>
    </form>
  </body>
</html>
