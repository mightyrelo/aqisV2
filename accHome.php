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
    <title>AccSight Home</title>
    <link rel="stylesheet" href="aqsLogin.css">
  	<link rel="stylesheet" href="homeStyle.css">
</head>
<body>
    <?php
    require_once "navigationBar.php";
    ?>
  	<img src="Jet Engineering.gif" width="300px" height="160px" id="pic">
    <h2 id="heading">Hello <?php echo $_SESSION['username']?> ,Welcome to AccSight!</h2>
 
</body>
</html>