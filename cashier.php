<!DOCTYPE html>
<html>
	
<head>
	<title>POS</title>
	<link href="style/cashier.css" type="text/css" rel="stylesheet" />
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{background-color: #CB4335; 
        	font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }</style></head>

	<body>

		<img src="images/logo.png" class="logo">
		<div class="search-div">
			 <form name="search">
				<input type="text" placeholder="Search" class="search" value=""> 
			</form>

			<input class="BtnSignOut" type="button" name="sign out" value="sign out" onclick="index.php">
			<p class="order">Order no. 000</p>
			
		</div>

			<div class="receipt">
				<p class="descrip">Aimm's Meat and More</p>	
		<!-- <div class="yehet"> -->
			<p id="separator">-------------------------------------------------------------</p><br>
				
				<p class="pname">NAME </p>
					
				<p class="pquant"> QTY </p>						

				<p class="peach"> EACH </p>
				
				<p class="ptotal"> TOTAL </p>
					
					<button class="checkout">Checkout</button> 
					
						<button class="done">Done</button>
							
								
								<!--	</div>-->

									
							
</div>
		<div class="panel">

				<div class="prod">
		
			
			<p class="product"> PRODUCTS </p> <br>

			</div>	


			<button class="category">Category</button><br>
			<button class="butt">Fruits</button><br>
			<button class="butt">Vegetables</button><br>
			<button class="butt">Meat</button><br>
			<button class="butt">Dairy</button><br>
			<button class="butt">Canned Goods</button><br>
			<button class="butt">Herbs & Spices </button><br>
			<button class="butt">Seafoods</button><br>
			</div>
		
		

		

	</body>

</html>


