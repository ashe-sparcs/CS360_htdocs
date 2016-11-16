<?php 
	$page_title = 'CS360 HW6 / '.basename(__FILE__);
	include('../includes/header.html');
?>
<p>Insert new Laptop information into tables Product and Laptop if there is no Laptop with that model number.</p>
<p><b>No blanks are allowed.</b></p>
<form action="result3.php" method="get">
	<div>
		  <label>Manufacturer : </label><input type="text" name="maker"><br><br>
		  <label>Model : </label><input type="text" name="model"><br><br>
		  <label>Speed : </label><input type="text" name="speed"><br><br>
		  <label>RAM : </label>
		  <select name="ram">
		      <option value="1">1GB</option>
			  <option value="2">2GB</option>
			  <option value="3">4GB</option>
			  <option value="4">8GB</option>
		  </select>
		  <br><br>
		  <label>Hard disk size : </label><input type="text" name="hd"><br><br>
		  <label>Screen size : </label><input type="text" name="screen"><br><br>
		  <label>Price : </label><input type="text" name="price"><br><br>
		  <input type="submit" value="Insert a Laptop" style="margin-left: 260px">
	</div>
</form>
<?php 
	include('../includes/footer.html');
?>