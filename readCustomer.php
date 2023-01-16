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
    <title>AccSight Customers</title>
    
</head>
<body>
<?php
    require_once "navigationBar.php";
    ?>
    <h2>AccSight Customers</h2>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Full Names</th>
            <th>Cell Number</th>
            <th>Address</th>
        </tr>
        <?php
        //connect to server
        require_once "connect.php";
        //run query
        $sql = "SELECT * FROM customer;";
        if(!($result = mysqli_query($connection,$sql))){
            die("Could not run query on table");
        }
        //display results
        while($row = mysqli_fetch_assoc($result)){
            print "\t<tr>\n";
            foreach($row as $dat){
                print "<td>{$dat}</td>";
            }
            print "</tr>\n";
        }
        ?>
    </table>     
</body>
</html>

