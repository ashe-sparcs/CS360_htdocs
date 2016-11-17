<?php 
	$page_title = 'CS360 HW6 / '.basename(__FILE__);
	include('../includes/header.html');
?>
<p>Find the cheapest "system" (PC plus printer or Laptop plus printer) that is within the "budget" (total price of a PC (or a Laptop) and printer), and minimum speed.</p>
<p>Make the printer a color printer (color = 1) if possible.</p>
<p><b>No blanks are allowed.</b></p>
<form action="result4.php" method="get">
	<!--Implement an input form -->
	<div>
		  <label>Budget : </label><input type="text" name="budget"><br><br>
		  <label>Minimum speed : </label><input type="text" name="minimumSpeed"><br><br>
		  <input type="submit" value="Find the PC or the Laptop" style="margin-left: 260px">
	</div>
</form>
<?php 
	include('../includes/footer.html');
?>