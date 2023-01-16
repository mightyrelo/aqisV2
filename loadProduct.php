<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:accLogin.php');
    }
?>

<?php
    //collect data from form
    $pName = $_POST['pro_name'];
    $dsc = $_POST['desc'];
    $trd = $_POST['trade'];
    $ret = $_POST['retail'];


    //connect to server
    require_once "connect.php";

    //make first query
    $result = mysqli_query($connection,"SELECT MAX(pro_id) FROM product");
    $row = mysqli_fetch_row($result);
    $id = $row[0]+1;

    //make query
    $sql = "INSERT INTO product (pro_id,pro_name,pro_desc,trade,retail) VALUES"; 
    $sql .= "('" . $id . "',";
    $sql .= "'" . $pName . "',";
    $sql .= "'" . $dsc . "',";
    $sql .= "'" . $trd . "',";
    $sql .= "'" . $ret . "')";

    if(!($result = mysqli_query($connection,$sql))){
        die("Could not query table");
    }
    require_once "readProduct.php";

?>