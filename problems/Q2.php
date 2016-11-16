<?php 
	$page_title = 'CS360 HW6 / '.basename(__FILE__);
	include('../includes/header.html');
?>
<p>Find at most 3 PCs whose prices are closet to the desired price.</p>
<form action="result2.php" method="get">
	<!--Implement an input form -->
	Enter a price : <input type="text" name="desiredPrice">
	<input type="submit" value="Find PCs">
</form>
<?php 
	include('../includes/footer.html');
?>