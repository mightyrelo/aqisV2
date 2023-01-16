<?php

     $quoteId = $_POST['qId'];
     $comm = $_POST['comm'];
     //connect to server and select database
     require_once "connect.php";

     $result5 = mysqli_query($connection,"SELECT MAX(acc_id) FROM account");
     $row = mysqli_fetch_row($result5);
     $acc_id = $row[0]+1;
     
     
     //based on the customer name read in, we get customer id
     if(!($result = mysqli_query($connection,"SELECT cus_id FROM quotation WHERE quote_id = '$quoteId';"))){
         die("could not run query on table");
     }
     //collect data
     $row = mysqli_fetch_row($result);
     $c_id = $row[0];

     //read quoteItems from server
     //make query
     $exp = 0;
     $total = 0;
     $sql = "SELECT * FROM quoteItem;";
     if(!($result = mysqli_query($connection,$sql))){
           die("could not run query on table");
     }
     //collect and display
     while($row = mysqli_fetch_assoc($result)){
         //current quote id is...
         $curQID = $row["quote_id"];
         //if current matches this one
         if($curQID == $quoteId){
            //tally up
            $prod_id = $row["prod_id"];
            $quant = $row["quantity"];
            //these two are all you need for a description
            //or rather I need the product name
            if(!($result3 = mysqli_query($connection,"SELECT pro_name FROM product WHERE pro_id = '$prod_id';"))){
                die("cannot query");
            }
            $row = mysqli_fetch_row($result3);
            $prod_name = $row[0];
                
            if(!($result2 = mysqli_query($connection,"SELECT trade FROM product WHERE pro_id = '$prod_id'"))){
                die("could not complete query");
            }
            $row = mysqli_fetch_row($result2);
            $trade = $row[0];
            //add to running total
            $exp = $exp + $trade*$quant;
            
            if(!($result2 = mysqli_query($connection,"SELECT retail FROM product WHERE pro_id = '$prod_id'"))){
                die("could not complete query");
            }
            $row = mysqli_fetch_row($result2);
            $retail = $row[0];
            //add to running total
            $total = $total + $retail*$quant;
        }         
     }

     $profit = $total-$exp-$comm;

     //now we can finally create a quotation
     $sql = "INSERT INTO account (acc_id,quote_id,amount,expense,commission,profit) VALUES"; 
     $sql .= "('" . $acc_id . "',";
     $sql .= "'" . $quoteId . "',";
     $sql .= "'" . $total . "',";
     $sql .= "'" . $exp . "',";
     $sql .= "'" . $comm . "',";
     $sql .= "'" . $profit . "')";

     if(!($result = mysqli_query($connection,$sql))){
        die("Could not query table");
     }

     //require_once "readAccount.php";
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
<?php
    require_once "navigationBar.php";
   ?>
<h4>Account Added to Server</h4>
    <table>
        <tr>
            <th>quote_id</th>
            <th>customer_id</th>
            <th>amount</th>
            <th>expense</th>
            <th>commission</th>
            <th>profit</th>
            <th>release date</th>
        </tr>
        <?php
            require_once "connect.php";
            //make query
            $sql = "SELECT * FROM account WHERE quote_id = '$quoteId';";
            if(!($result = mysqli_query($connection,$sql))){
                die("Could not make query on table");
            }
            //extract and display
            while($row = mysqli_fetch_assoc($result)){
                print "<tr>\n";
                foreach($row as $data){
                    print "\t<td>{$data}</td>\n";
                }
                print "</tr>";
            }
        ?>
    </table>
</body>
</html>
