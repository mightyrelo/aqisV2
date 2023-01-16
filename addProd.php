<?php
    session_start();
    //collect data from form
    $pName = $_POST['prod'];
    $quant = $_POST['quantity'];
    //the hidden form field is also passed
    $quoteId = $_POST['quoteID'];

    //header('location:compileQuote.php');

    require_once "connect.php";

    //we also need to create an item id
    if(!($result = mysqli_query($connection,"SELECT MAX(item_id) FROM quoteItem"))){
        die("Could not query table");
    }
    $row = mysqli_fetch_row($result);
    $item_id = $row[0]+1;

    //first query
    $sql = "SELECT pro_id FROM product WHERE pro_name LIKE";
    $sql .= "'" . $pName . "'";
    if(!($result = mysqli_query($connection,$sql))){
        die("could not complete query");
    }
    $row = mysqli_fetch_row($result);
    $prod_id = $row[0];

    //make query
    $sql = "INSERT INTO quoteItem (item_id,quote_id,prod_id,quantity) VALUES"; 
    $sql .= "('" . $item_id . "',";
    $sql .= "'" . $quoteId . "',";
    $sql .= "'" . $prod_id . "',";
    $sql .= "'" . $quant . "')";
    if(!($result = mysqli_query($connection,$sql))){
        die("Could not query table");
    }


    require "addProd2.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="addProd2.php" method="post">
        

    </form>
</body>
</html>
