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
    <h2>Select Quote ID</h2>
    
    <form action="printedQuote.php" method="post">
        <label for="qId">Quote ID</label>
        <select name="qId">
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

           while($row = mysqli_fetch_assoc($result)){
               $quote_id = $row["quote_id"];
               $quote_desc = $row["quote_desc"];
               $desc = "Description: " . $quote_desc;
                print "<option>$quote_id</option>";
           }
           print "</select>";
           print "<p>$desc</p>" 
        ?>
        <input type="submit" value="Pick Quote">
    </form>  
</body>
</html>