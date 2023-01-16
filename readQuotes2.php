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
    <h2>Quotations on Server</h2>
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
            $sql = "SELECT * FROM quotation;";
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
