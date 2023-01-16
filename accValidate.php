<?php

    session_start();
    header('location:accLogin.php');

    //collect data from forms
    $name = $_POST['uName'];
    $word = $_POST['uPass'];

    //process data
    require_once "connect.php";

    $sql = "SELECT * FROM sysUser WHERE uName = '$name' && uPass = '$word';";
    $result = mysqli_query($connection,$sql);
    $num = mysqli_num_rows($result);

    $sql = "SELECT uNick FROM sysUser WHERE uName = '$name' && uPass = '$word';";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_row($result);
    $nick = $row[0];
      

    if($num == 1){
        $_SESSION['username'] = $nick;
        header('location:accHome.php');
    }
    else{
        header('location:accLogin.php');
    }
?>