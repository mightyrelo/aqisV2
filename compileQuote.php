<?php
       //collect data from forms
       $cName = $_POST['customer'];
       //quoteID now available, don't have to create a new one
       $quoteId = $_POST['quoteID'];
       //connect to server and select database
       require_once "connect.php";
       
       //based on the customer name read in, we get customer id
       $sql = "SELECT cus_id FROM customer WHERE cus_name LIKE";
       $sql .= "'" . $cName . "'";
       if(!($result = mysqli_query($connection,$sql))){
           die("could not run query on table");
       }

       //collect data
       $row = mysqli_fetch_row($result);
       $c_id = $row[0];

       //read quoteItems from server
       //make query
       $total = 0;
       $desc = "";
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
                $desc .= $quant . "x" . $prod_name . ",";
                        
                if(!($result2 = mysqli_query($connection,"SELECT retail FROM product WHERE pro_id = '$prod_id'"))){
                    die("could not complete query");
                }
                $row = mysqli_fetch_row($result2);
                $retail = $row[0];
                //add to running total
                $total = $total + $retail*$quant; 
            }           
       }

       //now we can finally create a quotation
       $sql = "INSERT INTO quotation (quote_id,cus_id,quote_desc,amount) VALUES"; 
       $sql .= "('" . $quoteId . "',";
       $sql .= "'" . $c_id . "',";
       $sql .= "'" . $desc . "',";
       $sql .= "'" . $total . "')";

       //echo $c_id;
       //insert into table
       if(!($result = mysqli_query($connection,$sql))){
          die("Could not query table");
       }

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
<h4>Quote Added to Server</h4>
    <table>
        <tr>
            <th>quote_id</th>
            <th>customer_id</th>
            <th>Summary</th>
            <th>amount</th>
            <th>release_date</th>
        </tr>
        <?php
            require_once "connect.php";
            //make query
            $sql = "SELECT * FROM quotation WHERE quote_id = '$quoteId';";
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

