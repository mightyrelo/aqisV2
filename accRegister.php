<?php

    session_start();    

    //collect data from forms
    $name = $_POST['uName'];
    $word = $_POST['uPass'];
    $nick = $_POST['alias'];
    $ref = $_POST['ref'];

    //process data
    require_once "connect.php";
    $sql = "SELECT * FROM sysUser WHERE uName = '$name';";
    $result = mysqli_query($connection,$sql);
    $num = mysqli_num_rows($result);

    if($num == 1){
        echo "User name already exists";

    }
    else{
        $sql = "INSERT INTO sysUser (uName,uPass,uNick) VALUES ('$name','$word','$nick');";
        mysqli_query($connection,$sql);
        header('location:accLogin.php');
        //echo "Registration Successful";
    }
?>