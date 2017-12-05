<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$product_name_input = $category = $rpoint = $qut = $qoh = $original_price = $selling_price = "";
$product_name_input_err = $category_err = $rpoint_err = $qut_err = $qoh_err = $original_price_err = $selling_price_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_product_name_input = trim($_POST["product_name_input"]);
    if(empty($input_product_name_input)){
        $product_name_input_err = "Please enter a name.";
    } else{
        $product_name_input = $input_product_name_input;
    }

    // Validate address
    $input_category = trim($_POST["category"]);
    if(empty($input_category)){
        $category_err = 'Please select an category.';
    } else{
        $category = $input_category;
    }

        // Validate address
    $input_rpoint = trim($_POST["rpoint"]);
    if(empty($input_rpoint)){
        $rpoint_err = 'Please enter reorder point.';
    } else{
        $rpoint = $input_rpoint;
    }

    $input_qut = trim($_POST["qut"]);
    if(empty($input_qut)){
        $qut_err = "Please enter a quantity type.";
    } else{
        $qut = $input_qut;
    }

        // Validate address
    $input_qoh = trim($_POST["qoh"]);
    if(empty($input_qoh)){
        $qoh_err = 'Please enter quantity.';
    } else{
        $qoh = $input_qoh;
    }

        // Validate address
    $input_original_price = trim($_POST["original_price"]);
    if(empty($input_original_price)){
        $original_price_err = 'Please enter original price.';
    } else{
        $original_price = $input_original_price;
    }

        // Validate address
    $input_selling_price = trim($_POST["selling_price"]);
    if(empty($input_selling_price)){
        $selling_price_err = 'Please enter selling price.';
    } else{
        $selling_price = $input_selling_price;
    }

    // Check input errors before inserting in database
    if(empty($product_name_input_err) && empty($category_err) && empty($rpoint_err) && empty($qoh_err) && empty($original_price_err) && empty($selling_price_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO product (name, unit_sale_price, unit_cost_price, quantity_unit_type, quantity_on_hand, reorder_point, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sdddddi", $param_product_name_input, $param_unit_sale_price, $param_unit_cost_price, $param_quantity_unit_type, $param_quantity_on_hand, $param_reorder_point, $param_category_id);

            // Set parameters
            $param_product_name_input = $product_name_input;
            $param_unit_sale_price = $selling_price;
            $param_unit_cost_price = $original_price;
            $param_quantity_unit_type = $qut;
            $param_quantity_on_hand = $qoh;
            $param_reorder_point = $rpoint;
            $param_category_id = $category;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                // window.location.replace('admin.php');
                $product_id = mysqli_insert_id($link);
                $sqlStock_in ="INSERT INTO stock_in (product_id, quantity, cost_price, total_price) 
                VALUES 
                (" . $product_id . ", " . $qoh . ", " . $original_price . ", " . $qoh*$original_price . ")";
                if(mysqli_query($link, $sqlStock_in)){
                    echo "Product Added";
                    echo "<script type='text/javascript'> $('#addproduct-submit').hide(); </script>";
                } else {
                    echo "Error in adding stock";
                }

                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
}
?>
<div class="col-lg-6">
    <div class="form-group <?php echo (!empty($product_name_input_err)) ? 'has-err' : ''; ?>">
        <label for="product_name_input">Product Name: </label>
        <input type="text" " name="product_name_input" class="form-control" value="<?php echo $product_name_input; ?>" Required/>
        <span class="help-block"><?php echo $product_name_input_err;?></span>
    </div>
    <div class="form-group <?php echo (!empty($category_err)) ? 'has-err' : ''; ?>">
        <label for="category">Category: </label>
        <select id="category" name="category"  class="form-control">
            <?php
            require_once "config.php";
            $sql = "SELECT * FROM category";
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        echo '<option value="'. $row['id'].'">'.$row['name'].'</option>';
                    }
                }
            }

             mysqli_close($link);
            ?>
        </select>
        <span class="help-block"><?php echo $category_err;?></span>
    </div>
    <div class="form-group <?php echo (!empty($qut_err)) ? 'has-err' : ''; ?>">
        <label for="product_name_input">Quantity Type: </label>
        <input type="text" " name="qut" class="form-control" value="<?php echo $qut; ?>" Required/>
        <span class="help-block"><?php echo $qut_err;?></span>
    </div>
    <div class="form-group <?php echo (!empty($rpoint_err)) ? 'has-err' : ''; ?>">
        <label for="rpoint">Reorder Point : </label>
        <input type="number" class="form-control" name="rpoint" value="<?php echo $rpoint; ?>" Required/>
        <span class="help-block"><?php echo $rpoint_err;?></span>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group <?php echo (!empty($qoh_err)) ? 'has-err' : ''; ?>">
        <label for="qoh">Stock-in: </label>
        <input type="number" class="form-control" placeholder="Quantity" name="qoh" id="qoh" value="<?php echo $qoh; ?>" Required/>
        <span class="help-block"><?php echo $qoh_err;?></span>
    </div>
    <div class="form-group <?php echo (!empty($original_price_err)) ? 'has-err' : ''; ?>">
        <input type="number" class="form-control" placeholder="Original Price (each)" id="original_price" name="original_price" value="<?php echo $original_price; ?>" Required/>
        <span class="help-block"><?php echo $original_price_err;?></span>
    </div>
    <div class="form-group">
        <input type="number" class="form-control" placeholder="Total (Original)" id="original_total" name="original_total" disabled="" />
    </div>
    <div class="form-group <?php echo (!empty($selling_price_err)) ? 'has-err' : ''; ?>">
        <input type="number" class="form-control" placeholder="Selling Price (each)" id="selling_price" name="selling_price" value="<?php echo $selling_price; ?>" Required/>
        <span class="help-block"><?php echo $selling_price_err;?></span>
    </div>
    <div class="form-group">
        <input type="number" class="form-control" placeholder="Total (Selling)" id="selling_total" name="selling_total" disabled="" />
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#selling_price").keyup(function() {
            var value = $(this).val();
            var quantity = $("#qoh").val();
            var total = value * quantity;
            $("#selling_total").val(total);
        });

        $("#original_price").keyup(function() {
            var value = $(this).val();
            var quantity = $("#qoh").val();
            var total = value * quantity;
            $("#original_total").val(total);
        });

        $("#category").val("<?php echo $category; ?>");
    });
</script>