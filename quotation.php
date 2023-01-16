<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:accLogin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quotation</title>
   
</head>
<body>
	<?php
    require_once "navigationBar.php";
    ?>
    <h2>Select Client</h2>
  
    <form action="addProd2.php" method="post">
        <div>
            <label for="customer">Select Customer</label>
            <select name="customer" id="customer">
                <?php
                    require_once "connect.php";
                    //make query
                    $sql = "SELECT cus_name FROM customer;";
                    if(!($result = mysqli_query($connection,$sql))){
                        die("Could not query customer");
                    }
                    //extract and display as option on select
                    while($row = mysqli_fetch_assoc($result)){
                       
                        foreach($row as $cus){
                            print "<option>{$cus}</option>";   
                        }
                    }
                ?>
            </select>
        </div>
        <div>
                    <input type="submit" name="sb" value="Pick Client">
                </div>
        
</body>
</html>