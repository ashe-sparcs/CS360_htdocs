<?php
	#result3.php

	/** Implement the function 'insert_Laptop'
		- Explanation: insert laptop info into tables Product and PC if there is no Laptop with that model number.
		- Input: db connection info($conn), laptop info($maker,$model,$speed,$ram,$hd,$screen,$price)
		- Output: true if the insertion is success, false otherwise
	*/
	function insert_Laptop($conn,$maker,$model,$speed,$ram,$hd,$screen,$price){
		$queryResult = true;

		//implement..
		$selectResult = $conn->query("select * from product where model=" . $model);
		if ($tuple = $selectResult->fetchRow()) {
			$queryResult = false;
		} else {
			$prepQueryProduct = $conn->prepare("insert into product values ('?',?,'laptop')");
			$productArgs = array($maker, $model);
			$result1 = $conn->execute($prepQueryProduct, $productArgs);
			$prepQueryLaptop = $conn->prepare("insert into laptop values (?,?,?,?,?,?)");
			$laptopArgs = array($model, $speed, $ram, $hd, $screen, $price);
			$result2 = $conn->execute($prepQueryLaptop, $laptopArgs);
			error_log($result1);
			error_log($result2);
			$queryResult = $result1 and $result2;
			/*
			$prepQuery_product = $conn->query("delete from product where model=" . $model);
			$prepQuery_laptop = $conn->query("delete from laptop where model=" . $model);
			*/
		}
		
		return $queryResult;
	}
?>
<?php
	if(!isset($validPrint)){
		$page_title = 'CS360 HW6 / '.basename(__FILE__);
		include('../includes/header.html');	
		include('../Config/db.connect.php');
		if (!PEAR::isError($conn)){

			/* Implement an ouput screen*/
			$maker = $_GET['maker'];
			$model = $_GET['model'];
			$speed = $_GET['speed'];
			$ram= $_GET['ram'] * 1024;
			$hd = $_GET['hd'];
			$screen= $_GET['screen'];
			$price = $_GET['price'];
			
			if (insert_Laptop($conn, $maker, $model, $speed, $ram, $hd, $screen, $price)){
				echo "success";
			} else {
				echo "fail";
			}
			$conn->disconnect();
		}
		include('../includes/footer.html');
	}
?>
