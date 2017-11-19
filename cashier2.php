<!DOCTYPE html>
<html>
	
<head>
	<title>POS</title>
	<link href="css/style.css" type="text/css" rel="stylesheet" />
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  
</head>
	<body>
		
		  <div class="asd col-xs-12">
		  		<div class="container">
		  		 	<div class="row">
		  		 		<div class="col-lg-4">
		  		 			<img src="images/logo.png" class="img-responsive">
		  		 		</div>
		  		 		<div class="col-lg-4">
		  		 			<p class="order">Order no. 000</p>
		  		 		</div>
		  		 		<div class="col-lg-4">
		  		 			<div class="form-group">
                        <input type="text" name="search" placeholder="search" class="form-control" value="<?php $search?>"></div>
		  		 			
		  		 		</div>
		  		 	</div>

		  		 	<div class="row">
		  		 		<div class="receipt col-lg-5">
		  		 			<div class="row"><p class="StoreName">Aimm's Meat and More</p>
		  		 			<br>
		  		 			<p class="Separator">-------------------------------------------------------------</p><br></div>
		  		 			
		  		 			<div class="col-xs-12"><table>
		  		 				<tr>Name</tr>
		  		 				<tr>Qty</tr>
		  		 				<tr>Each</tr>
		  		 				<tr>Total</tr>
		  		 			</table>
		  		 				
		  		 			</div>
		  		 			
		  		 			<div class="row" style="text-align: center;">
		  		 				<input type="button" class="BtnRcpt" name="BtnCkOut" value="Check Out" onclick="">
		  		 				<input type="button" class="BtnRcpt" name="BtnDone" value="Done" onclick="">
		  		 			</div>
		  		 			
		  		 		</div>
		  		 		<div class="products col-lg-7">
		  		 			<p class="prod">PRODUCTS</p>
			  		 		<input type="button" name="BtnProd" value="Category" class="BtnProd"><br>
			  				<input type="button" name="BtnProd" value="Fruits" class="BtnProd"><br>
			  				<input type="button" name="BtnProd" value="Vegetables" class="BtnProd"><br>
		  		 			<input type="button" name="BtnProd" value="Meats" class="BtnProd"><br>
		  		 			<input type="button" name="BtnProd" value="Canned Goods" class="BtnProd"><br>
		  		 			<input type="button" name="BtnProd" value="Dairy" class="BtnProd"><br>
		  		 			<input type="button" name="BtnProd" value="Spices" class="BtnProd"><br>
		  		 			<input type="button" name="BtnProd" value="Herbs and Spices" class="BtnProd"><br>

		  		 		</div>
		  		 	</div>
		  		</div>

		  </div>


	</body>
	</html>

