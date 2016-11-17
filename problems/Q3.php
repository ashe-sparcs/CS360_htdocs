<?php 
	$page_title = 'CS360 HW6 / '.basename(__FILE__);
	include('../includes/header.html');
?>
<p>Insert new Laptop information into tables Product and Laptop if there is no Laptop with that model number.</p>
<p><b>No blanks are allowed.</b></p>
<script>
function validate(form) {
    // validation code here ...
	var speed, get_list;
	
	speed = document.getElementById("speed").value;
	get_list = document.querySelectorAll("input[type=text]");
	for (index = 0; index < get_list.length; ++index) {
		if (get_list[index].value == "") {
			alert('No blanks in the input forms are allowed.');
			return false;
		}
	}

    if(speed >= 3.0) {
        alert('A speed of Laptop should be less than 3.0');
        return false;
    }
    else {
		return true;
    }
}
</script>
<form onsubmit="return validate(this)" action="result3.php" method="get">
	<div>
		  <label style="display: inline-block; width: 250px; float: left; clear: left; text-align: right">Manufacturer : </label><input style="display: inline-block; float: left; margin-left: 10px" type="text" name="maker"><br><br>
		  <label style="display: inline-block; width: 250px; float: left; clear: left; text-align: right">Model : </label><input style="display: inline-block; float: left; margin-left: 10px" type="text" name="model"><br><br>
		  <label style="display: inline-block; width: 250px; float: left; clear: left; text-align: right">Speed : </label><input style="display: inline-block; float: left; margin-left: 10px" id="speed" type="text" name="speed"><br><br>
		  <label style="display: inline-block; width: 250px; float: left; clear: left; text-align: right">RAM : </label>
		  <select style="display: inline-block; float: left; margin-left: 10px" name="ram">
		      <option value="1024">1GB</option>
			  <option value="2048">2GB</option>
			  <option value="4096">4GB</option>
			  <option value="8192">8GB</option>
		  </select>
		  <br><br>
		  <label style="display: inline-block; width: 250px; float: left; clear: left; text-align: right">Hard disk size : </label><input style="display: inline-block; float: left; margin-left: 10px" type="text" name="hd"><br><br>
		  <label style="display: inline-block; width: 250px; float: left; clear: left; text-align: right">Screen size : </label><input style="display: inline-block; float: left; margin-left: 10px" type="text" name="screen"><br><br>
		  <label style="display: inline-block; width: 250px; float: left; clear: left; text-align: right">Price : </label><input style="display: inline-block; float: left; margin-left: 10px" type="text" name="price"><br><br>
		  <input style="display: inline-block; float: left; margin-left: 260px" type="submit" value="Insert a Laptop">
	</div>
</form>
<?php 
	include('../includes/footer.html');
?>