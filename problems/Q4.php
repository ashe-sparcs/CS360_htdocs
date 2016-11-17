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
		  <label style="display: inline-block; width: 250px; float: left; clear: left; text-align: right">Budget : </label><input style="display: inline-block; float: left; margin-left: 10px" type="text" name="budget"><br><br>
		  <label style="display: inline-block; width: 250px; float: left; clear: left; text-align: right">Minimum speed : </label><input style="display: inline-block; float: left; margin-left: 10px" type="text" name="minimumSpeed"><br><br>
		  <input style="display: inline-block; float: left; margin-left: 260px" type="submit" value="Find the PC or the Laptop">
	</div>
</form>
<?php 
	include('../includes/footer.html');
?>