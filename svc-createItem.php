<?php
	// database write
	include("../gbdd_dbconfig/dbconfig.php");
	$mysqli = new mysqli($MYSQL_DBSERVER, $MYSQL_USERNAME, $MYSQL_PASSWORD, $MYSQL_DATABASE);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	if (!($stmt = $mysqli->prepare("INSERT INTO gbdd_items (item_name, onset) VALUES (?, ?)"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	
	// TODO: actually set stuff
	
	$stmt->close();
	$mysqli->close();
?>
