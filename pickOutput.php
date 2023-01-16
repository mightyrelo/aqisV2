<?php
    if($_POST["sb"] == "Print PO"){
       
        require_once "printedPO.php";
    }
    else{
       
        require_once "printedInvoice.php";
    }
?>