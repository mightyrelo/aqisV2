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
    <title>Load Quote ID</title>
   
</head>
<body>
<?php
    require_once "navigationBar.php";
    ?>
    <h2>Select Account ID</h2>
    
    <form action="pickOutput.php" method="post">
        <label for="acId">Acc ID</label>
        <select name="acId">
        <?php
            $cus_name = $_POST["cName"];

            require_once "connect.php";
            
            //from the cus name I get the cus id
            if(!($result3 = mysqli_query($connection,"SELECT cus_id FROM customer WHERE cus_name = '$cus_name';"))){
                die("cannot query");
            }
            $row = mysqli_fetch_row($result3);
            $c_id = $row[0];

            //from cus id we get quote id
           $sql2 = "SELECT quote_id,quote_desc FROM quotation WHERE cus_id = '$c_id';";
           if(!($result = mysqli_query($connection,$sql2))){
               die("dquery failed");
           }
           //get all accounts that match current quote id.
           //We can make many accounts from a single quote
           while($row = mysqli_fetch_assoc($result)){
               $quote_id = $row["quote_id"];
               //from the quote_id we can give list of account ids belonging to this client
               $sql2 = "SELECT acc_id FROM account WHERE quote_id = '$quote_id';";
               if(!($result2 = mysqli_query($connection,$sql2))){
                   die("not running");
               }
               while($row2 = mysqli_fetch_assoc($result2)){
                   $acc_id = $row2["acc_id"];
                   print "<option>$acc_id</option>";
               }    
           }
           print "</select>";
           print "<p>$desc</p>" 
        ?>
        <div>
            <input type="submit" name = "sb" value="Print PO">
            <input type="submit" name = "sb" value="Print Invoice">
        </div>
    </form>  
</body>
</html>