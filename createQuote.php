<?php
    #collect data from form
    $cName = $_POST['customer'];
    //$pName = $_POST['prod'];
    //$quant = $_POST['quantity'];

    #process data
    //find product
    require_once "connect.php";
    //make query
    $sql = "SELECT cus_id FROM customer WHERE cus_name LIKE";
    $sql .= "'" . $cName . "'";
    if(!($result = mysqli_query($connection,$sql))){
        die("could not run query on table");
    }
    //collect data
    $row = mysqli_fetch_row($result);
    $c_id = $row[0];

    $result = mysqli_query($connection,"SELECT MAX(quote_id) FROM quotation");
    $row = mysqli_fetch_row($result);
    $q_id = $row[0]+1;

    //make another query for product details
    $sql = "SELECT retail FROM product WHERE pro_name LIKE";
    $sql .= "'" . $pName . "'";
    if(!($result = mysqli_query($connection,$sql))){
        die("could not complete query");
    }
    $row = mysqli_fetch_array($result);
    $rPrice = $row["retail"];
    $amount = $rPrice*$quant;


    //$desc = <<< EOD "$quant x $pName" EOD;
    $desc = "$quant x $pName";

    //now we have enough info to create a quotation entry
    $sql = "INSERT INTO quotation (quote_id,cus_id,quote_desc,amount) VALUES"; 
    $sql .= "('" . $q_id . "',";
    $sql .= "'" . $c_id . "',";
    $sql .= "'" . $desc . "',";
    $sql .= "'" . $amount . "')";

    if(!($result = mysqli_query($connection,$sql))){
        die("Could not query table");
    }

    require_once "readQuotes.php";
?>