<html>

<head>
    <script src="lib/jquery/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link href="css/style.css" type="text/css" rel="stylesheet" >
</head>

<body>

    <div class="col-lg-12" style="background-color: White; height: 600px; overflow: auto;">
        <br>
        <table class="table table-hover table-responsive results">
            <thead>
                <tr style="font-size: 8pt;">
                    <th> Select</th>
                    <th> Product Id </th>
                    <th> Name </th>
                    <th> Selling Price </th>
                    <th> Original Price </th>
                    <th> QTY </th>
                    <th> Total </th>
                    <th> Reorder Point </th>
                    <th> Edit Reorder Point</th>
                </tr>
            </thead>
            <tbody id="myUL">
                <?php
                include_once "config.php";
                $sql = "SELECT * FROM product";
                            if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_array($result)){

                            if($row['quantity_on_hand']<$row['reorder_point']){
                                echo "<tr class='bg-danger'>";
                                echo "<td>  <input type='checkbox' checked='checked'></td>";

                            }
                            else{
                                echo "<tr scope='row'>";
                                echo "<td>  <input type='checkbox'></td>";
                            }


                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['unit_sale_price'] . "</td>";
                            echo "<td>" . $row['unit_cost_price'] . "</td>";
                            echo "<td>" . $row['quantity_on_hand'] . "</td>";
                            echo "<td>" . $row['quantity_on_hand'] * $row['unit_cost_price'] . "</td>";
                            echo "<td>" . $row['reorder_point'] . "</td>";
                            echo "<td><button id='infoProduct' class='btn btn-primary btn-xs' data-name=". $row['name'] . " data-id=" . $row['id'] . " data-title='Info' data-toggle='modal' data-target='#product-info' ><span class='glyphicon glyphicon-edit'></span></button></td>";
                            echo "</tr>";
                        }
                        mysqli_free_result($result);
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>