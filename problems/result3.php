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
			$prepQueryProduct = $conn->prepare("insert into product(maker, model, type) values (?,?,'laptop')");
			$productArgs = array($maker, $model);
			$result1 = $conn->execute($prepQueryProduct, $productArgs);
			$prepQueryLaptop = $conn->prepare("insert into laptop(model, speed, ram, hd, screen, price) values (?,?,?,?,?,?)");
			$laptopArgs = array($model, $speed, $ram, $hd, $screen, $price);
			$result2 = $conn->execute($prepQueryLaptop, $laptopArgs);
			$queryResult = $result1 and $result2;
			$selectResult1 = $conn->query("select * from product where model=" . $model);
			$selectResult2 = $conn->query("select * from laptop where model=" . $model);
			if ($tuple1 = $selectResult1->fetchRow() and $tuple2 = $selectResult2->fetchRow()) {
				$queryResult = true;
			} else {
				$queryResult = false;
			}
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
			$ram= $_GET['ram'];
			$hd = $_GET['hd'];
			$screen= $_GET['screen'];
			$price = $_GET['price'];
			
			$attributeName = array("MAKER", "MODEL", "SPEED", "RAM", "HD", "SCREEN", "PRICE");
			echo "<br><br>";
			echo '<table border="1" align="center" style="width: 500px">';
			if (insert_Laptop($conn, $maker, $model, $speed, $ram, $hd, $screen, $price)){
				echo '<caption>The PC below is inserted.</caption>';
			} else {
				echo "<caption>The PC below can't be inserted. Model " . $model . " already exists.</caption>";
			}
			echo "<tr>";
			for($i=0;$i<7;$i++) {
				echo "<th>" . $attributeName[$i] . "</th>";
			}
			echo "</tr>";
			echo "<tr>";
			for($j=0;$j<7;$j++) {
				echo "<th>" . $_GET[strtolower($attributeName[$j])] . "</th>";
			}
			echo "</tr>";
			echo '</table>';
			/*
			$commonString = "The laptop with (" . $maker . ", " . $model. ", " . $speed. ", " . $ram. ", " . $hd. ", " . $screen . ", " . $price . ")";
			if (insert_Laptop($conn, $maker, $model, $speed, $ram, $hd, $screen, $price)){
				echo $commonString . " is inserted.";
			} else {
				echo $commonString . " can't be inserted.<br>The model " . $model . " already exists.";
			}
			*/
			$conn->disconnect();
		}
		include('../includes/footer.html');
	}
?>
