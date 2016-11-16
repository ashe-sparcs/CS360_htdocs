<?php 
	$page_title = 'CS360 HW6 / '.basename(__FILE__);
	include('../includes/header.html');
?>
<p>Insert new Laptop information into tables Product and Laptop if there is no Laptop with that model number.</p>
<p><b>No blanks are allowed.</b></p>
<form action="result3.php" method="get">
	<!--Implement an input form -->
	Manufacturer : <input type="text" name="maker"><br>
	Model : <input type="text" name="model"><br>
	Speed : <input type="text" name="speed"><br>
	Hard disk size : <input type="text" name="hd"><br>
	Screen size : <input type="text" name="screen"><br>
	Price : <input type="text" name="desiredPrice">
</form>
<?php 
	include('../includes/footer.html');
?>