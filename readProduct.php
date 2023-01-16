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
<?php
    require_once "navigationBar.php";
    ?>
    <h2>AccSight Products</h2>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Trade Price</th>
            <th>Retail Price</th>
        </tr>
        <?php
            //connect to server
          	require_once "connect.php";
            //make query
            $sql = "SELECT * FROM product;";
            if(!($result = mysqli_query($connection,$sql))){
                die("could not run query on table");
            }
            //collect and display
            while($row = mysqli_fetch_assoc($result)){
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