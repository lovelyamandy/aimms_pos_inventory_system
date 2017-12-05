<?php
// Include config file
//require_once 'config.php';
require_once 'session-admin.php';
?>

<html>

<head>
    <title>Aimm's POS and Inventory System</title>
    <script src="lib/jquery/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link href="css/style.css" type="text/css" rel="stylesheet" >
    <style type="text/css">
    .results tr[visible='false'],
    .no-result{
      display:none;
  }

  .results tr[visible='true']{
      display:table-row;
  }

  .counter{
      padding:8px; 
      color:#ccc;
  }
</style>
</head>

<body>
    <div class="col-lg-12">
        <div class="container">
            <div class="col-lg-3" style="text-align: center; background-color: #D5DBDB; height:700px;" >
                 <img src="images/adminlogo.png" class="img-responsive admin_logo" style="width: 150px;height:150px;margin-left:50px;">
                <p style="text-align: center;">ADMIN</p> 
                    <div class="menu-div">
                        <input type="button" class="view_inv" value="View Inventory" disabled="true" style="background-color:#B2BABB; ">
                        <input type="button" class="report" value="Report" onclick="window.location.href='report.php'">
                        <input type="button" class="report" value="Accounts" onclick="window.location.href='accounts.php'">
                        <input type="button" class="report" value="Log-out" onclick="window.location.href='end-session.php'">
                    </div>    
            </div>
            
            <div class="col-lg-9 content" style="height: 700px;">

                <div class="col-lg-12" style="background-color: White">
                    <div class="row" style="border-bottom: solid 1px #BFC9CA; padding-bottom: 3px;">
                        <input type="text" class="search form-control pull-right" placeholder="Search">
                        <input type="button" value="Add Product" name="" class="BtnAdmin" id="add-product-button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add-product-modal">
                    </div>
                   
                    <div class="modal fade" id="add-product-modal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="add-product-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="modal-header">
                                        <p type="button"  style="font-family:Arial; font-size: 14pt; ">Add Product</p>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid" id="dynamic-addproduct">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" id="addproduct-submit" class="btn btn-primary">Submit</button>
                                        <button type="button" id="close-addproduct-modal" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                   
                    <!-- <span class="counter pull-right"></span> -->

                    <div class="col-lg-12" style="background-color: White;  height: 530px; height: 530px; overflow: auto;">
                        <br>
                        <table class="table table-hover table-responsive results"">
                            <thead>
                                <tr style="font-size: 8pt;">
                                    <th> Product Id </th>
                                    <th> Name </th>
                                    <th> Selling Price </th>
                                    <th> Original Price </th>
                                    <th> QTY </th>
                                    <th> Total </th>
                                    <th> Reorder Point </th>
                                    <th> Action </th>
                                </tr>
                                <tr class="warning no-result">
                                    <td colspan="8"><i class="fa fa-warning"></i> No result</td>
                                </tr>
                            </thead>
                            <tbody id="dynamic-product-table">
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
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control " type="text" placeholder="Mohsin">
                        </div>
                        <div class="form-group">
                            <input class="form-control " type="text" placeholder="Irshad">
                        </div>
                        <div class="form-group">
                            <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer ">
                        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
                    </div>
                </div> 
            </div>
        </div>

            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                    </div>

                    <div class="modal-body">
                        <div id="delete-dialog" class="alert alert-danger"></div>
                    </div>

                    <div class="modal-footer ">
                        <button id="delete-yes-button" type="button" data-id="" data-name="" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        <button id="delete-no-button" type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="product-info" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="add-product-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="modal-header">
                            <p id="product-info-title" type="button"  style="font-family:Arial; font-size: 14pt; "></p>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid" id="dynamic-product-info">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" id="addproduct-submit" class="btn btn-primary">Submit</button>
                            <button type="button" id="close-addproduct-modal" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".search").keyup(function () {
                var searchTerm = $(".search").val();
                var listItem = $('.results tbody').children('tr');
                var searchSplit = searchTerm.replace(/ /g, "'):containsi('");

                $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                }
            });

                $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
                    $(this).attr('visible','false');
                    console.log("asdsad");
                });

                $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
                    $(this).attr('visible','true');
                });

                var jobCount = $('.results tbody tr[visible="true"]').length;
                $('.counter').text(jobCount + ' item');

                if(jobCount == '0') {$('.no-result').show();}
                else {$('.no-result').hide();}
            });

            $(document).on('click', '#deleteProduct', function(e){

                e.preventDefault();

                var uid = $(this).attr('data-id'); // get id of clicked row
                var name = $(this).attr('data-name');
                $('#delete-dialog').html("<span class='glyphicon glyphicon-warning-sign'></span> Are you sure you want to delete " + name + "?");
                // $('#product-name').html(name);
                $('#delete-yes-button').attr('data-id', uid);
                $('#delete-yes-button').attr('data-name', name);
            });

            $(document).on('click', '#delete-yes-button', function(e){

                e.preventDefault();

                var uid = $(this).attr('data-id'); // get id of clicked row
                var name = $(this).attr('data-name');

                $.ajax({
                    url: 'delete-product.php',
                    type: 'POST',
                    data: 'id='+uid,
                    dataType: 'html'
                })
                
                .done(function(data){
                    // console.log(data);
                    $('#delete-dialog').html('');
                    $('#delete-dialog').html(data);
                    $('#delete-yes-button').hide();
                    $('#delete-no-button').html("<span class='glyphicon glyphicon-remove'></span> Close");
                    $.ajax({
                        url: "product-table.php",
                        method: "POST",
                        dataType: "html"
                    })

                    .done(function(table) {
                        $("#dynamic-product-table").html(table);
                    });
                })

                $(document).on('click', '#delete-no-button', function(e){
                    $(this).html("<span class='glyphicon glyphicon-remove'></span> No");
                    $('#delete-yes-button').show();
                });
            });

            $(document).on('click', '#add-product-button', function(e){
               $("#dynamic-addproduct").load("addproduct.php");
            });

            $(document).on('click', '#addproduct-submit', function(e){

                e.preventDefault();
                var name = $("#add-product-form input[name=product_name_input]").val();
                var category = $("#add-product-form select[name=category]").val();
                var reorder = $("#add-product-form input[name=rpoint]").val();
                var qut = $("#add-product-form input[name=qut]").val();
                var qoh = $("#add-product-form input[name=qoh]").val();
                var oPrice = $("#add-product-form input[name=original_price]").val();
                var sPrice = $("#add-product-form input[name=selling_price]").val();
                console.log(name);
                var strData = 'product_name_input='+name+'&category='+category+'&qut='+qut+'&rpoint='+reorder+'&qoh='+qoh+'&original_price='+oPrice+'&selling_price='+sPrice;
                console.log(strData);
                //add porduct modal
                $.ajax({
                    url: 'addproduct.php',
                    type: 'POST',
                    data: strData,
                    dataType: 'html'
                })
                
                .done(function(data){
                    // console.log(data);
                    $('#dynamic-addproduct').html('');
                    $('#dynamic-addproduct').html(data);
                    // refresh the table after submit
                    $.ajax({
                        url: "product-table.php",
                        method: "POST",
                        dataType: "html"
                    })

                    .done(function(table) {
                        $("#dynamic-product-table").html(table);
                    });
                })
                //show submit button
                $(document).on('click', '#close-addproduct-modal', function(e){
                    $("#addproduct-submit").show();
                });
            });

            $(document).on('click', '#infoProduct', function(e){

                var uid = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                var name = $("#add-product-form input[name=product_name_input]").val();
                var category = $("#add-product-form select[name=category]").val();
                var reorder = $("#add-product-form input[name=rpoint]").val();
                var qut = $("#add-product-form input[name=qut]").val();
                var qoh = $("#add-product-form input[name=qoh]").val();
                var oPrice = $("#add-product-form input[name=original_price]").val();
                var sPrice = $("#add-product-form input[name=selling_price]").val();
                $('#product-info-title').html("Product Info - " + name);

                $.ajax({
                    url: 'product-info.php',
                    type: 'POST',
                    data: 'id='+uid,
                    dataType: 'html'
                })

                .done(function(data){
                    // console.log(data);
                    $('#dynamic-product-info').html('');
                    $('#dynamic-product-info').html(data);
                    // refresh the table after submit
                });
            });
        });
    </script>
</body>
</html>
