<?php 
	$page_title = 'CS360 HW6 / '.basename(__FILE__);
	include('../includes/header.html');
?>
<p>Find at most 3 PCs whose prices are closet to the desired price.</p>
<form action="result2.php" method="get">
	<!--Implement an input form -->
	<div>
		  <label style="display: inline-block; width: 250px; float: left; clear: left; text-align: right">Enter a price : </label><input style="display: inline-block; float: left; margin-left: 10px" type="text" name="desiredPrice">
		  <input style="display: inline-block; float: left; margin-left: 10px" type="submit" value="Find PCs">
	</div>
</form>
<?php 
	include('../includes/footer.html');
?>