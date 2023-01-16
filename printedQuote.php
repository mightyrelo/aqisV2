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
    <title>Quote(Print Version)</title>
    <link rel="stylesheet" href="printedQuote.css">
</head>
<body>
    <div id="companyDetails">
        <a href="printQuote.php">
            <img src="AccLogo.png" id="logo" alt="AccSightLogo" width="300px" height="150px">
        </a>
        
        <p id="contact"><i>Plot 130, 3rd Street, Zuurbekom<br>
            Westonaria, Gauteng </i><br>
            <i>www.acc-sight.co.za</i><br>
            <i>info@acc-sight.co.za</i> <br>
            <i>0789097150/0681313368</i>
        </p>
    </div>
        <p id="heading">Top Notch Access Control And Electronic Security Systems</p>
    <div>

    </div>
    <div id="clientDetails">
        <?php
            print "<br><br>";
            print "<b>Sold-To-Party</b><br>";
            $qID = $_POST['qId'];
            //from account id query quote id
            require_once "connect.php";
            $quote_id = $qID;

            //from quote_id we pull cus_id
            if(!($result4 = mysqli_query($connection,"SELECT cus_id FROM quotation WHERE quote_id = '$quote_id';"))){
                die("could not query table");
            }
            $row2 = mysqli_fetch_row($result4);
            $cus_id = $row2[0];
            //from cus_id we can pull customer details
            if(!($result4 = mysqli_query($connection,"SELECT cus_name FROM customer WHERE cus_id = '$cus_id';"))){
                die("could not query table");
            }
            $row2 = mysqli_fetch_row($result4);
            $cus_name = $row2[0];
            if(!($result4 = mysqli_query($connection,"SELECT cus_add FROM customer WHERE cus_id = '$cus_id';"))){
                die("could not query table");
            }
            $row2 = mysqli_fetch_row($result4);
            $cus_add = $row2[0];
            if(!($result4 = mysqli_query($connection,"SELECT cell_number FROM customer WHERE cus_id = '$cus_id';"))){
                die("could not query table");
            }
            $row2 = mysqli_fetch_row($result4);
            $cell_no = $row2[0];
          

            print $cus_name . "<br>";
            print $cus_add . "<br>";
            print "+27" . $cell_no . "<br>";

        ?>
    </div>
    <div id="invoiceSpecs">
            <?php
                
                $today=date("F j, Y, g:i a");
                $next_date= date("F j, Y, g:i a", strtotime($today. ' + 90 days'));
                print "<b>QUOTATION</b><br>";
                print "<b>Quote ID:</b>          ACSQ" . $qID. "<br>";
                print "<b>Release Date:</b>    " . date("F j, Y, g:i a") . "<br>";
                print "<b>Valid Until:</b>    " . $next_date . "<br>";
                print "<br>";
            ?>
    </div>
    <div id="quote">
        <table id="tb">
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
            <?php
                //read from form
                $qID = $_POST['qId'];
                require_once "connect.php";
                //make query
               // print $qID;
                $sql = "SELECT * FROM quoteItem;";
                if(!($result = mysqli_query($connection,$sql))){
                    die("could not run query on table");
                }
                //collect and display
                $total = 0;
                while($row = mysqli_fetch_assoc($result)){
                    //add only ones that match requested quote ID.
                    if($qID == $row["quote_id"]){
                        $pro_id = $row["prod_id"];
                        $quantity = $row["quantity"];
                        //from pro id we can get name, description and price
                        //$sql = "SELECT pro_name,pro_desc,retail FROM product WHERE pro_id = '$pro_id'"
                        if(!($result2 = mysqli_query($connection,"SELECT pro_name,pro_desc,retail FROM product WHERE pro_id = '$pro_id'"))){
                            die("cannot run query");
                        }
                        $row = mysqli_fetch_assoc($result2);
                        $pro_name = $row["pro_name"];
                        $pro_desc = $row["pro_desc"];
                        $retail = $row["retail"];
                        $amount = $retail*$quantity;
                        $total += $amount; 
                        print "<tr>\n";
                        print "\t<td>$pro_name</td>\n";
                        print "\t<td>$pro_desc</td>\n";
                        print "\t<td>$quantity</td>\n";
                        print "\t<td>$retail</td>\n";
                        print "\t<td>$amount</td>\n";                    
                        print "</tr>";
                    }
                }
                //print empty tows
                for($i = 0; $i < 3;$i++){
                    print "<tr>\n";
                    print "\t<td></td>\n";
                    print "\t<td></td>\n";
                    print "\t<td></td>\n";
                    print "\t<td></td>\n";
                    print "\t<td></td>\n";                    
                    print "</tr>";
                }
                //print total
                print "<tr>\n";
                print "\t<td></td>\n";
                print "\t<td></td>\n";
                print "\t<td></td>\n";
                print "\t<td class='line'><b>Total(Excl. VAT)<b></td>\n";
                print "\t<td>$total</td>\n";                    
                print "</tr>";

                 //print total
                $vat = $total*0.15;
                print "<tr>\n";
                print "\t<td></td>\n";
                print "\t<td></td>\n";
                print "\t<td></td>\n";
                print "\t<td><b>VAT(15%)<b></td>\n";
                print "\t<td>$vat</td>\n";                    
                print "</tr>";

                  //print total
                  $output = $total + $vat;
                  print "<tr>\n";
                  print "\t<td></td>\n";
                  print "\t<td></td>\n";
                  print "\t<td></td>\n";
                  print "\t<td><b>Total(incl. VAT)<b></td>\n";
                  print "\t<td>$output</td>\n";                    
                  print "</tr>";
                ?>
        </table>
        <div>
            <p id="banking">
                <b>Our Banking Details</b> <br>
                <b>Bank</b>: First National Bank (FNB) <br>
                <b>Account Holder</b>: Access Control Insight (Pty) Ltd <br>
                <b>Account Number</b>: 62870714641 <br>
                <b>Reference</b>: Quote ID <br>
            </p>
        </div>
    </div>
</body>
</html>