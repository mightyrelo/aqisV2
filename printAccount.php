<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:accLogin.php');
    }
?>

<?php
    $accId = $_POST["accId"]; 
    if($_POST["sb"] == "Print Invoice"){
       require_once "printInvoice.php";
    }
    else{
        require_once "printPO.php";
    }
?>

