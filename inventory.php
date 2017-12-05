<html>

<head>
	<title>Aimm's POS and Inventory System</title>

	<link href="css/inventory.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="style/bootstrap.min.css">
</head>

	<body>
			<div class="menu-cont">
				<img src="images/adminlogo.png" class="admin_logo">
				<p class="admin">ADMIN</p> 
				<div class="menu-div">
					<button class="view_inv">view inventory</button>
					<button class="report">Report</button>
					<button class="report">Accounts</button>
					<button class="report">Log-out</button>
				</div>
			</div>
			<div>
			<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Search Product..." autocomplete="off" />
			<a rel="facebox" href="addproduct.php"><Button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;" /><i class="icon-plus-sign icon-large"></i> Add Product</button></a><br><br>
			<table class="hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
				<thead>
					<tr>
						<th width="12%"> Product ID </th>
						<th width="15%"> Product Name </th>
						<th width="10%"> Category ID</th>
						<th width="9%"> Selling Price</th>
						<th width="9%">  Cost Price  </th>
						<th width="10%"> Quantity on hand </th>
						<th width="9%">  Reorder Point </th>
						<th width="10%"> Action </th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</body>
</html>