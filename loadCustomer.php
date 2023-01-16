<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:accLogin.php');
    }
?>

<?php
    //collect data from form
    $cName = $_POST['cus_name'];
    $cCell = $_POST['cell'];
    $cAdd = $_POST['address'];

    //connect to server
 	require_once "connect.php";
    //make query
    $sql = "INSERT INTO customer (cus_name,cell_number,cus_add) VALUES"; 
    $sql .= "('" . $cName . "',";
    $sql .= "'" . $cCell . "',";
    $sql .= "'" . $cAdd . "')";

    if(!($result = mysqli_query($connection,$sql))){
        die("Could not query table");
    }

    require_once "readCustomer.php";

?>