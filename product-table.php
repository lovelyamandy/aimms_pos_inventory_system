<?php
include_once "config.php";
$sql = "SELECT * FROM product";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            echo "<tr scope='row'>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['unit_sale_price'] . "</td>";
            echo "<td>" . $row['unit_cost_price'] . "</td>";
            echo "<td>" . $row['quantity_on_hand'] . "</td>";
            echo "<td>" . $row['quantity_on_hand'] * $row['unit_cost_price'] . "</td>";
            echo "<td>" . $row['reorder_point'] . "</td>";
            echo "<td>";
            echo "<button id='deleteProduct' class='btn btn-danger btn-xs' data-name=". $row['name'] . " data-id=" . $row['id'] . " data-title='Delete' data-toggle='modal' data-target='#delete' ><span class='glyphicon glyphicon-trash'></span></button>";
            echo "<button id='infoProduct' class='btn btn-primary btn-xs' data-name=". $row['name'] . " data-id=" . $row['id'] . " data-title='Info' data-toggle='modal' data-target='#product-info' ><span class='glyphicon glyphicon-menu-hamburger'></span></button>";
            echo "</td>";
            echo "</tr>";
        }
        mysqli_free_result($result);
    }
}
?>