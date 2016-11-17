<?php
	#result4.php

	/** Implement the function 'find_system'
		- Explanation: Return the infomation (all the attributes) of the cheapest system.
		- Input: db connection info($conn), system info($budget,$speed)
		- Output: an array of the system
			For example, the form of output value is
				array(
					"PC" => array(
						"MODEL" => 1007,
						"SPEED" => 2.20,
						"RAM" => 1024,
						"HD" => 200,
						"PRICE" => 510
					),
					"Printer" => array(
						"MODEL" => 3003,
						"color" => 1,
						"type" => 'laser',
						"PRICE" => 899
					)
				);
			or
				array(
					"Laptop" => array(
						"MODEL" => 2003,
						"SPEED" => 1.80,
						"RAM" => 512,
						"HD" => 60,
						"SCREEN" => 15.4,
						"PRICE" => 549
					),
					"Printer" => array(
						"MODEL" => 3003,
						"color" => 1,
						"type" => 'laser',
						"PRICE" => 899
					)
				);			
	*/
	function find_system($conn,$budget,$speed){
		$queryResult = array();
		$minPrice = INF;
		$minPC = array();
		$minLaptop = array();
		$minPrinter = array();
		global $isLaptop;

		//implement..
		$pcResult = $conn->query("select * from pc");
		while ($tuple = $pcResult->fetchRow()) {
			$speedTemp = $tuple[1];
			$priceTemp = $tuple[4];
			if ($speedTemp >= $speed and $priceTemp < $minPrice) {
				$minPrice = $priceTemp;
				$minPC["MODEL"] = $tuple[0];
				$minPC["SPEED"] = $tuple[1];
				$minPC["RAM"] = $tuple[2];
				$minPC["HD"] = $tuple[3];
				$minPC["PRICE"] = $tuple[4];
			}
		}
		$laptopResult = $conn->query("select * from laptop");
		while ($tuple = $laptopResult->fetchRow()) {
			$speedTemp = $tuple[1];
			$priceTemp = $tuple[4];
			if ($speedTemp >= $speed and $priceTemp < $minPrice) {
				$minPrice = $priceTemp;
				$minLaptop["MODEL"] = $tuple[0];
				$minLaptop["SPEED"] = $tuple[1];
				$minLaptop["RAM"] = $tuple[2];
				$minLaptop["HD"] = $tuple[3];
				$minLaptop["SCREEN"] = $tuple[4];
				$minLaptop["PRICE"] = $tuple[5];
			}
		}
		if ($minPC["PRICE"] < $minLaptop["PRICE"]) {
			$queryResult["PC"] = $minPC;
		} else {
			$isLaptop = true;
			$queryResult["Laptop"] = $minLaptop;
		}
		$minPrice2 = INF;
		$printerResult = $conn->query("select * from printer where color=1");
		while ($tuple = $printerResult->fetchRow()) {
			$priceTemp = $tuple[3];
			if ($priceTemp < $minPrice2) {
				$minPrice2 = $priceTemp;
				$minPrinter["MODEL"] = $tuple[0];
				$minPrinter["color"] = $tuple[1];
				$minPrinter["type"] = $tuple[2];
				$minPrinter["PRICE"] = $tuple[3];
			}
		}
		if ($minPrice + $minPrice2 > $budget) {
			$printerResult = $conn->query("select * from printer where color=0");
			while ($tuple = $printerResult->fetchRow()) {
				$priceTemp = $tuple[3];
				if ($priceTemp < $minPrice2) {
					$minPrice2 = $priceTemp;
					$minPrinter["MODEL"] = $tuple[0];
					$minPrinter["COLOR"] = $tuple[1];
					$minPrinter["TYPE"] = $tuple[2];
					$minPrinter["PRICE"] = $tuple[3];
				}
			}
			if ($minPrice + $minPrice2 > $budget) {
				return false;
			} else {
				$queryResult["Printer"] = $minPrinter;
			}
		} else {
			$queryResult["Printer"] = $minPrinter;
		}
		return $queryResult;
	}
?>
<?php
	$isLaptop = false;
	if(!isset($validPrint)){
		$page_title = 'CS360 HW6 / '.basename(__FILE__);
		include('../includes/header.html');	
		include('../Config/db.connect.php');
		if (!PEAR::isError($conn)){

			/* Implement an ouput screen*/
			$budget = $_GET["budget"];
			$speed = $_GET["minimumSpeed"];
			echo "Budget: " . $budget . " Speed: " . $speed;
			echo "<br><br>";
			$mySystem = find_system($conn,$budget,$speed);
			if ($mySystem) {
				if ($isLaptop) {
					$attributeName = array('MANUFACTURER', 'MODEL', 'SPEED', 'RAM', 'HD', 'SCREEN', 'PRICE');
					echo '<table border="1" align="center" style="width: 500px">';
					echo '<caption>Laptop</caption>';
					echo "<tr>";
					for($i=0;$i<7;$i++) {
						echo "<th>" . $attributeName[$i] . "</th>";
					}
					echo "</tr>";
					echo "<tr>";
					for($j=0;$j<7;$j++) {
						echo "<th>" . $mySystem["Laptop"][$attributeName[$j]] . "</th>";
					}
					echo "</tr>";
					echo '</table>';
					$total = $mySystem["Laptop"]["PRICE"] + $mySystem["Printer"]["PRICE"];
				} else {
					$attributeName = array('MODEL', 'SPEED', 'RAM', 'HD', 'PRICE');
					echo '<table border="1" align="center" style="width: 500px">';
					echo '<caption>PC</caption>';
					echo "<tr>";
					for($i=0;$i<5;$i++) {
						echo "<th>" . $attributeName[$i] . "</th>";
					}
					echo "</tr>";
					echo "<tr>";
					for($j=0;$j<5;$j++) {
						echo "<th>" . $mySystem["PC"][$attributeName[$j]] . "</th>";
					}
					echo "</tr>";
					echo '</table>';
					$total = $mySystem["PC"]["PRICE"] + $mySystem["Printer"]["PRICE"];
				}
				echo "<br>";
				$attributeName = array('MODEL', 'color', 'type', 'PRICE');
				echo '<table border="1" align="center" style="width: 500px">';
				echo '<caption>Printer</caption>';
				echo "<tr>";
				for($i=0;$i<4;$i++) {
					echo "<th>" . strtoupper($attributeName[$i]) . "</th>";
				}
				echo "</tr>";
				echo "<tr>";
				for($j=0;$j<4;$j++) {
					echo "<th>" . $mySystem["Printer"][$attributeName[$j]] . "</th>";
				}
				echo "</tr>";
				echo '</table>';
				echo "<br><br>";
				echo "Total price: " . $total;
			} else {
				echo "No systems satisfying budget and minimum speed.";
			}
			$conn->disconnect();
		}
		include('../includes/footer.html');
	}
?>
