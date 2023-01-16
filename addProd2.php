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
    <h2>Create Quotation</h2>
    <?php

        $cName = $_POST["customer"];
        //connect and link to base
        require_once "connect.php";
        //make query
        if(!($result = mysqli_query($connection,"SELECT MAX(quote_id) FROM quotation;"))){
                die("Could not make query on table");
        }
        $row = mysqli_fetch_row($result);
        $q_id = $row[0]+1;


    ?>
        <div>
            <form action="addProd.php" method="post">
                <input type="hidden" name="quoteID" value="<?php print $q_id?>">
                <input type="hidden" name="customer" value="<?php print $cName?>">
                <div>
                    <label for="prod">Select Product</label>
                    <select name="prod" id="prod">
                    <?php
                            require_once "connect.php";
                            //make query
                            $sql = "SELECT pro_name FROM product;";
                            if(!($result = mysqli_query($connection,$sql))){
                                die("Could not query customer");
                            }
                            //extract and display as option on select
                            while($row = mysqli_fetch_assoc($result)){
                            
                                foreach($row as $pro){
                                    print "<option>{$pro}</option>";   
                                }
                            }
                        ?>
                    </select>
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity">
                    <input type="submit" name="sb" value="Add to Quote">
                </div>
                
            </form>
        </div>
        <div>
            <form action="compileQuote.php" method="post">
                <input type="hidden" name="quoteID" value="<?php print $q_id?>">
                <input type="hidden" name="customer" value="<?php print $cName?>">
                <div>
                    <input type="submit" name="sb" value="Quote">
                </div>
            </form>
        </div>
</body>
</html>