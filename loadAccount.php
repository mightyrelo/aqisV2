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
    <title>Print Quote</title>
</head>
<body>
	<?php
    require_once "navigationBar.php";
    ?>
    <h2>Select Customer</h2>
    <form action="loadQuoteID2.php" method="post">
        <label for="cName">Client Name</label>
            <select name="cName" id="cName">
                <?php
                    require_once "connect.php";
                    //make query
                    $sql = "SELECT cus_name FROM customer;";
                    if(!($result = mysqli_query($connection,$sql))){
                        die("could not make query");
                    }
                    //read rows and place as option
                    while($row = mysqli_fetch_assoc($result)){
                        foreach($row as $data){
                            print "<option>{$data}</option>";
                        }
                    }
                ?>
            </select>
            <input type="submit" value="Pick Name">
    </form>
</body>
</html>