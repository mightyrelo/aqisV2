<?php
    //connect to server
    if(!($connection = mysqli_connect("localhost","accsight_katlego","K@stx8909"))){
        die("could not connect to server");
    }

    //select database
    if(!(mysqli_select_db($connection,"accsight_AccSight"))){
        die("could not find database on server");
    }
?>