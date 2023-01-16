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
    <title>AccSight Quotations</title>
   
</head>
<body>
<?php
    require_once "navigationBar.php";
    ?>
    <h2>AccSight Accounts</h2>
    <table>
        <tr>
            <th>account_id</th>
            <th>quote_id</th>
            <th>total</th>
            <th>expenses</th>
            <th>commission</th>
            <th>profit</th>
            <th>approval_date</th>
        </tr>
        <?php
            require_once "connect.php";
            //make query
            $sql = "SELECT * FROM account;";
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
