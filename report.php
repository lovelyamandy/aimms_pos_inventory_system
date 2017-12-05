<?php
// Include config file
// require_once 'config.php';
require_once 'session-admin.php';
?>

<html>

    <head>
        <title>Aimm's POS and Inventory System</title>
        <link rel="stylesheet" type="text/css" href="/style/bootstrap.css">
        <link href="css/style.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>

    <body>
        <div class="col-lg-12">
             <div class="container">   
                <div class="col-lg-3" style="text-align: center; background-color: #D5DBDB; height:700px;">

                    <img src="images/adminlogo.png" class="img-responsive admin_logo" style="width: 150px;height:150px;margin-left:50px;">
                    <p style="text-align: center;">ADMIN</p> 

                    <div class="menu-div">
                        <input type="button" class="view_inv" value="View Inventory" onclick="window.location.href='admin.php'">
                        <input type="button" class="report" value="Report" disabled="true" style="background-color:#B2BABB;">
                        <input type="button" class="report" value="Accounts" onclick="window.location.href='accounts.php'">
                        <input type="button" class="report" value="Log-out" onclick="window.location.href='end-session.php'">
                    </div>
                </div> 
                <div class="col-lg-9 content" style="height: 700px;">
                    <div class="col-lg-12" style="background-color: White">
                    <div class="row" style="border-bottom: solid 1px #BFC9CA; padding-bottom: 3px;">
                    <b style="font-size: 14pt;"> Sales Report</b>
                    </div>
                   <!--  <br> -->
                        <div class="row col-lg-12" style="height: 580px; ">
                            <br>
                            <br>
                            <label>From <input type="date" name="date" class="form-control" style="width: 200px;"></label>
                            <label>To <input type="date" name="date" class="form-control" style="width: 200px;"></label>
                            <input class="btn btn-primary" type="button" value="search" style="margin-left: 50px;">
                            <br>
                            <br>
                            <div class="col-lg-12" style="background-color: #BFC9CA; height: 500px; overflow: auto;">
                                <table class="table table-bordered tableRpt" data-responsive="table">
                                    <thead>
                                        <tr style="font-size: 8pt; justify-content: center;">
                                            <th width="13%"> Transaction ID </th>
                                            <th width="13%"> Transaction Date </th>
                                            <th width="20%"> Customer Name </th>
                                            <th width="16%"> Invoice Number </th>
                                            <th width="18%"> Amount </th>
                                            <th width="13%"> Profit </th>
                                        </tr>
                                    </thead>
                                     <tbody id="myUL">
                                    <?php
                                    include_once "config.php";
                                    $sql = "SELECT * FROM product";
                                     if($result = mysqli_query($link, $sql)){
                                        if(mysqli_num_rows($result) > 0){
                                           
                                            while($row = mysqli_fetch_array($result)){
                                                echo "<tr class='' id='product-button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#product-modal'>";
                                               
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['name'] . "</td>";
                                                echo "<td>" . $row['unit_sale_price'] . "</td>";
                                                // echo "<td>" . $row['quantity_on_hand'] . "</td>";
                                                // echo "<td>" . $row['quantity_on_hand'] * $row['unit_cost_price'] . "</td>";
                                               
                                                echo "</tr>";
                                            }
                                            
                                            mysqli_free_result($result);
                                        }
                                    }
                                    ?>
                                </tbody>

                                </table>
                            </div>
                        </div>
                  
                   </div>

                </div>
            </div>

        </div>
    </body>

</html>
