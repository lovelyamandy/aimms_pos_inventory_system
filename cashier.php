<?php

require_once 'session-cashier.php';

?>
<!DOCTYPE html>
<html>

<head>
	<title>POS</title>
	<script src="lib/jquery/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
	<script src="lib/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
	<link href="css/style.css" type="text/css" rel="stylesheet" >
</head>
<body>

	<div class="asd col-xs-12">
		<div class="container" style="background-color: #E74C3C;">
			<div class="row" style="height: 150px">

				<div class="col-lg-4" style="height: 150px">
					<img src="images/logo.png" class="img-responsive" style="height: 150px; width: 250px;">
				</div>
				<div class="col-lg-3 pull-left" style="height: 150px">

					<p class="order">Order no. 000</p>
				</div>

				<div class="col-lg-4" style="height: 150px">
					<div class="form-group" style=" margin-top: 5px;">
						<input type="text" name="search" placeholder="search" class="form-control" value="<?php $search?>">
					</div>
				</div>
				<div class="col-lg-1 pull-left" style="height: 150px">
					<input type="button" name="BtnLogOut" value="log out" onclick="window.location.href='end-session.php'" style="background-color: #E74C3C;border-color:  #E74C3C; border-style: none; color: White; font-size: 12pt; letter-spacing: .5pt; margin-top: 12px;">
				</div>
			</div>
			<!-- div sa resibo -->
			<div class="row">
				<!--div sa PRODUCTS  -->
				<div class="products col-lg-7">
					<div class="col-lg-12" style="background-color: White; height: 600px; overflow: auto;">
						<br>
						<table class="table table-hover table-responsive results">
							<thead>
								<tr style="font-size: 8pt;">

									<th> Product Id </th>
									<th> Name </th>
									<th> Selling Price </th>
								</tr>
							</thead>
							<tbody id="myUL">
								<?php
								include_once "config.php";
								$sql = "SELECT * FROM product";
								if($result = mysqli_query($link, $sql)){
									if(mysqli_num_rows($result) > 0){

										while($row = mysqli_fetch_array($result)){
								
											echo "<td>" . $row['id'] . "</td>";
											echo "<td>" . $row['name'] . "</td>";
											echo "<td>" . $row['unit_sale_price'] . "</td>";
											echo "<td><button id='add-quantity' class='btn btn-xs' data-name=". $row['name'] . " data-id=" . $row['id'] . " data-title='add-quantity' data-toggle='modal' data-target='#product-modal' ><span class='glyphicon glyphicon-plus'></span></button></td>";
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

				<div class="modal fade" id="product-modal" role="dialog">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<form id="product-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
								<div class="modal-header">
									<p type="button"  style="font-family:Arial; font-size: 14pt; ">Add Product</p>
								</div>
								<div class="modal-body"  style="text-align: center;">
									<div class="container-fluid" id="dynamic-product">
										<label>No. of Items:<input type="number" name="" class="form-control" style="width: 150px;" value="<?php $ItemQty; ?>"></label>
									</div>
								</div>

								<div class="modal-footer">
									<button type="button" id="product-submit" class="btn btn-primary">Submit</button>
									<button type="button" id="close-product-modal" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</form>
						</div>
					</div>
				</div>


				<div class="receipt col-lg-5">

					<div class="col-lg-12" style="overflow-y: auto; height: 392px; text-align: center; ">
						<table class="table table-hover table-responsive results">
							<thead>
								<tr>	
									<th>Product Name</th>
									<th>No. of Items</th>
									<th>Price</th>
									<th>Total</th>								
								</tr>
							</thead>
							<tbody>
								<?php
									
								?>
								
							</tbody>
							
						</table>
						
					</div>	
				</div>

				<div class="col-lg-4 row" style="text-align: center">
					<input type="button" class="btn btn-primary" id="BtnCkOut" value="Check Out" onclick="" style="width: 100px; margin-left: 50px;" data-toggle="modal" data-target="#BtnCkOut-modal">
					<input type="button" class="btn btn-primary" name="BtnDone" id="BtnDone" value="Done" onclick="" style="width: 100px; margin-left: 50px;">
				</div>

				<div class="modal fade" id="BtnCkOut-modal" role="dialog">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<form id="check-out-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
								<div class="modal-header">
									<p type="button"  style="font-family:Arial; font-size: 14pt; ">Check Out</p>
								</div>
								<div class="modal-body">
									<div class="container-fluid" id="dynamic-checkOut">
										<label style="vertical-align: center;margin: auto">Cash Tendered</label>
										<input type="number" name="" class="form-control" style="width: 200px;margin: auto">
									</div>
								</div>

								<div class="modal-footer">
									<button type="button" id="BtnCkOut-submit" class="btn btn-primary">Submit</button>
									<button type="button" id="close-BtnCkOut-modal" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

