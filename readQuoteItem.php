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
    <title>AccSight Products</title>
</head>
<body>
    <h2>AccSight Products</h2>
    <table>
        <tr>
            <th>Quote ID</th>
            <th>Customer ID</th>
           
        </tr>
        <?php
            //connect to server
            if(!($connection = mysqli_connect("localhost", "root", "K@stx8909"))){
                die("couldn't connect to server");
            }
            //select database
            if(!(mysqli_select_db($connection,"AccSight"))){
                die("coudn't find database on server");
            }
            //make query
            $sql = "SELECT * FROM quoteItem;";
            if(!($result = mysqli_query($connection,$sql))){
                die("could not run query on table");
            }
            //collect and display
            while($row = mysqli_fetch_assoc($result)){
                echo "here";
                print "<tr>\n";
                foreach($row as $dat){
                    print "\t<td>{$dat}</td>\n";
                }
                print "</tr>";
            }
        ?>
    </table>
</body>
</html>