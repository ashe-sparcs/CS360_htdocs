<?php
	#dbConnTest.php	

	/** Implement the function 'get_user_tables'
		- Explanation: Return all table names in your database
		- Input: db connection info, $conn, from db.connect.php file
		- Output: an array of table names of user_tables in your database, $user_tables
				For example, the form of output value is
				array(
				"TABLE_NAME" => array(
						0 => "PRODUCT",
						1 => "PC",
						2 => "LAPTOP",
						3 => "PRINTER"
					)
				);
	*/
	function get_user_tables($conn){
		$user_tables = array();

		//implement..
		$result = $conn->query("select table_name from user_tables");
		while ($tuple = $result->fetchRow()) {
			array_push($user_tables, $tuple[0]);
		}
		$user_tables = 
		array(
		"TABLE_NAME" => $user_tables
		);
		return $user_tables;
	}
?>
<?php
	if(!isset($validPrint)){
		$page_title = 'CS360 HW6 / '.basename(__FILE__);
		include('../includes/header.html');	
		include('../Config/db.connect.php');

		if (!PEAR::isError($conn)){
			echo '<p>Connected to Oracle!</p>';
			$arrTables =get_user_tables($conn);
			echo '<pre>';
			var_dump($arrTables);
			echo '</pre>';
			$conn->disconnect();
		}
		include('../includes/footer.html');
	}
?>
