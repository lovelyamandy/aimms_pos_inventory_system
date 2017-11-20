<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveproduct.php" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> Add Product</h4></center>
<hr>
<div id="ac">
<span>Product ID : </span><input type="text" style="width:265px; height:30px;" name="code" ><br>
<span>Product Name : </span><input type="text" style="width:265px; height:30px;" name="gen" Required/><br>
<span>Category ID : </span><input type="text" style="width:265px; height:30px;" name="gen" Required/><br>
<span>Selling Price : </span><input type="text" style="width:265px; height:30px;" name="gen" Required/><br>
<span>Cost Price : </span><input type="text" style="width:265px; height:30px;" name="gen" Required/><br>
<span>Quantity on Hand : </span><input type="text" id="txt1" style="width:265px; height:30px;" name="price" onkeyup="sum();" Required><br>
<span> Reorder Point : </span><input type="text" id="txt2" style="width:265px; height:30px;" name="o_price" onkeyup="sum();" Required><br>


</form>
