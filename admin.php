<?php
// Include config file
require_once 'config.php';
require_once 'session.php';


// Define variables and initialize with empty values
$username = $password = $confirm_password = $account_type = $first_name = $last_name = $address = $age = $gender = "";
$username_err = $password_err = $confirm_password_err = $account_type_err = $first_name_err = $last_name_err = $address_err = $age_err = $gender_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(empty(trim($_POST["account_type"]))){
        $account_type_err = "Please select";
    } else{
        $account_type = trim($_POST['account_type']);
        if ($account_type == 'cashier') {
            if (empty(trim($_POST["first_name"]))) {
                $first_name_err = "Please enter a firstname";
            } else {
                $first_name = trim($_POST["first_name"]);
            }

            if (empty(trim($_POST["last_name"]))) {
                $last_name_err = "Please enter a lastname";
            } else {
                $last_name = trim($_POST["last_name"]);
            }

            if (empty(trim($_POST["address"]))) {
                $address_err = "Please enter a address";
            } else {
                $address = trim($_POST["address"]);
            }

            if (empty(trim($_POST["age"]))) {
                $age_err = "Please enter a age";
            } else {
                $age = trim($_POST["age"]);
            }

            if (empty(trim($_POST["gender"]))) {
                $gender_err = "Please select a gender";
            } else {
                $gender = trim($_POST["gender"]);
            }
        }
    }
    
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($account_type_err)){

        // Prepare an insert statement
        $sqlUser = "INSERT INTO users (username, password, account_type) VALUES (?, ?, ?)";
        $sqlCashier = "INSERT INTO cashier (user_id_fk, name, address, age, gender) VALUES (?, ?, ?)";
       
        if ($account_type == "cashier") {
            if (empty($first_name_err) && empty($last_name_err) && empty($address_err) && empty($age_err) && empty($gender_err)) {
                if($stmt = mysqli_prepare($link, $sqlUser)){

                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_account_type);
                    
                    // Set parameters
                    $param_account_type = $account_type;
                    $param_username = $username;
                    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        $user_id = mysqli_insert_id($link);
                        $sqlCashier = "INSERT INTO cashier (user_id_fk, name, address, age, gender) VALUES (" . $user_id . ", '" . $first_name . " " . $last_name . "', '" . $address . "', " . $age . ", '" . $gender . "')";
                        echo $sqlCashier;
                        if(mysqli_query($link, $sqlCashier)){
                            header("location: login.php");
                        } else {
                            echo "Error in inserting cashier";
                        }
                    } else{
                        echo "Something went wrong. Please try again later.";
                    }
                }
            }
        } else {
            if($stmt = mysqli_prepare($link, $sqlUser)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_account_type);
    
                // Set parameters
                $param_account_type = $account_type;
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
    
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    header("location: login.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<html>

<head>
    <title>Aimm's POS and Inventory System</title>

    <link href="style/admin.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="style/bootstrap.min.css">
</head>

<body>
    <div class="col-xs-12">
        <div class="menu-cont">
            <img src="images/adminlogo.png" class="admin_logo">
            <p class="admin">ADMIN</p> 
            <div class="menu-div">
                <input type="button" class="view_inv" value="view inventory" onclick=""></input>
                <input type="button" class="report" value="Report" onclick=""></input>
                <input type="button" class="report" value="Accounts" onclick=""></input>
                <input type="button" class="report" value="Log-out" onclick=""></input>

            </div>
        </div> 
        <div class="panel_add_acc">
            <img src="images/download.png" class="avatar">

            <div class="acc_type col-md-5">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="user-info">
                    <div class="form-group <?php echo (!empty($account_type_err)) ? 'has-error' : ''; ?>">
                        <select class="form-control" name="account_type" id="account-type">
                            <option disabled selected>Account type</option>
                            <option value="admin">Admin</option>
                            <option value="cashier">Cashier</option>
                        </select>
                        <span class="help-block"><?php echo $account_type_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <input type="text" name="username" placeholder="Username" class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <input type="password" name="password" placeholder="Password" class="form-control" value="<?php echo $password; ?>">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" value="<?php echo $confirm_password; ?>">
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div id="cashier-div">
                        <div class="form-group <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                            <input type="text" name="first_name" placeholder="Firstname" class="form-control cashier-info" value="<?php echo $first_name; ?>">
                            <span class="help-block"><?php echo $first_name_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                            <input type="text" name="last_name" placeholder="Lastname" class="form-control cashier-info" value="<?php echo $last_name; ?>">
                            <span class="help-block"><?php echo $last_name_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <input type="text" name="address" placeholder="Address" class="form-control cashier-info" value="<?php echo $address; ?>">
                            <span class="help-block"><?php echo $address_err; ?></span>
                        </div>
                        <div class="form-group form-inline">   
                            <div class="form-group <?php echo (!empty($age_err)) ? 'has-error' : ''; ?>">
                                <input type="number" name="age" placeholder="Age" class="form-control cashier-info" value="<?php echo $age; ?>">
                                <span class="help-block"><?php echo $age_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($account_type_err)) ? 'has-error' : ''; ?>">
                                <select class="form-control cashier-info" name="gender">
                                    <option disabled selected>Gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                                <span class="help-block"><?php echo $gender_err; ?></span>
                            </div>
                        </div>    
                    </div>    
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <input type="reset" class="btn btn-default" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script language="JavaScript">
        
    var accountType = document.getElementById('account-type');
    var cashierInfo = document.getElementsByClassName('cashier-info');

    document.getElementById('cashier-div').style.display = "none";
    for (var i = 0; i < cashierInfo.length; i++) { 
        cashierInfo[i].disabled = true;
    }
   
    accountType.onchange = function () {
        
        if (accountType.selectedIndex != 2) {
            for (var i = 0; i < cashierInfo.length; i++) { 
                cashierInfo[i].disabled = true;
            }
            document.getElementById('cashier-div').style.display = "none";
        } else {
            for (var i = 0; i < cashierInfo.length; i++) { 
                cashierInfo[i].disabled = false;
            }
            document.getElementById('cashier-div').style.display = "block";
        }
        console.log(accountType.selectedIndex);
    };

    </script>
</body>
</html>
