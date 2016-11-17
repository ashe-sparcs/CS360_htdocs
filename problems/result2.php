<?php
	#result2.php	

	/** Implement the function 'find_3PCs'
		- Explanation: Return at most 3 PCs whose prices are closet to the inputted price.
		- Input: db connection info($conn), a price($price)
		- Output: an array of the specifications of 3PCs (that is, the maker, model number, ram, hd, and price)
				For example, the form of output value is
				array(
				0 => array(
						"MAKER" => "A",
						"MODEL" => 1001,
						"RAM" => 1024,
						"HD" => 250,
						"PRICE" => 2114
					),
				1 => array(
						"MAKER" => "A",
						"MODEL" => 1002,
						"RAM" => 512,
						"HD" => 250,
						"PRICE" => 995
					)
				);
	*/
	function price_diff($price1, $price2) {
		return abs($price1 - $price2);
	}
	
	function find_max($arr, $price) {
		$max_pair = 
				array(
				"diff" => 0, 
				"index" => -1
				);
		for ($i = 0; $i < 3; $i++) {
			$new_diff = price_diff($arr[$i]["PRICE"], $price);
			if ($new_diff > $max_pair["diff"]) {
				$max_pair["diff"] = $new_diff;
				$max_pair["index"] = $i;
			} 
		}
		return $max_pair;
	}
	function find_min($arr, $price) {
		$min_pair = 
				array(
				"diff" => INF, 
				"index" => -1
				);
		for ($i = 0; $i < 3; $i++) {
			$new_diff = price_diff($arr[$i]["PRICE"], $price);
			if ($new_diff < $min_pair["diff"]) {
				$min_pair["diff"] = $new_diff;
				$min_pair["index"] = $i;
			} 
		}
		return $min_pair;
	}
	function find_3PCs($conn,$price){
		$queryResult = array();
		$threePCs = array();
		
		//implement..
		$result = $conn->query("select * from product, pc where product.model = pc.model");
		for ($i = 0; $i < 3; $i++) {
			$tuple = $result->fetchRow();
			array_push($queryResult, array("MAKER" => $tuple[0], "MODEL" => $tuple[1], "RAM" => $tuple[5], "HD" => $tuple[6], "PRICE" => $tuple[7]));
		}
		$max_pair = find_max($queryResult, $price);
		for ($i = 3; $tuple = $result->fetchRow(); $i++) {
			$new_diff = price_diff($tuple[7], $price);
			if ($new_diff < $max_pair["diff"]) {
				$queryResult[$max_pair["index"]] = array("MAKER" => $tuple[0], "MODEL" => $tuple[1], "RAM" => $tuple[5], "HD" => $tuple[6], "PRICE" => $tuple[7]);
				$max_pair = find_max($queryResult, $price);
			}
		}
		$indexOfFirst = find_min($queryResult, $price)["index"];
		$indexOfLast = find_max($queryResult, $price)["index"];
		$indexOfMiddle = 3 - ($indexOfFirst + $indexOfLast);
		$threePCs[0] = $queryResult[$indexOfFirst];
		$threePCs[1] = $queryResult[$indexOfMiddle];
		$threePCs[2] = $queryResult[$indexOfLast];
		return $threePCs;
	}
?>
<?php
	if(!isset($validPrint)){
		$page_title = 'CS360 HW6 / '.basename(__FILE__);
		include('../includes/header.html');	
		include('../Config/db.connect.php');
		if (!PEAR::isError($conn)){
			
			/* Implement an ouput screen*/
			echo 'maker model ram hd price';
			echo '<br>';
			$queryResult = find_3PCs($conn, $_GET['desiredPrice']);
			for ($i = 0; $i < 3; $i++) {
				echo join(' ', $queryResult[$i]);
				echo '<br>';
			}
			$conn->disconnect();
		}
		include('../includes/footer.html');
	}
?>
