<?php
	// database read
	include("../gbdd_dbconfig/dbconfig.php");
	$mysqli = new mysqli($MYSQL_DBSERVER, $MYSQL_USERNAME, $MYSQL_PASSWORD, $MYSQL_DATABASE);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$res1 = $mysqli->query("
		SELECT 
			i.item_id       AS item_id,
			i.item_name     AS item_name,
			i.onset         AS item_onset,
			it.item_type_id AS item_type_id,
			t.type_id       AS type_id,
			t.type_name     AS type_name
		FROM
			gbdd_items i
			left join gbdd_item_type it ON it.item_id = i.item_id
			left join gbdd_types t      ON t.type_id = it.type_id
		ORDER BY item_id ASC
	");
	$counter = 0;
	while ($row1 = $res1->fetch_assoc()) {
		$arr1[$counter] = $row1;
		$counter++;
	}
	$res1->close();
	$mysqli->close();

	// cleanup arrays
	$narr1 = []; // it's a new array
	for ($i = 0; $i < count($arr1); $i++) {
		// add type to existing item in $narr1 if possible
		if (
			$i > 0                                             // there are no existing items in $narr1 if this is the first item in $arr1
			&& count($narr1) > $i-1                            // otherwise we get indexing problems each time
			&& $narr1[$i-1]["item_id"] == $arr1[$i]["item_id"] // match existing item using item_id
		) {
			array_push($narr1[$i-1]["types"], array(
				"item_type_id" => $arr1[$i]["item_type_id"],
				"type_id"      => $arr1[$i]["type_id"],
				"type_name"    => $arr1[$i]["type_name"]
			));
		
		// if no existing item in $narr1 then create it and populate with first possible type
		} else {
			array_push($narr1, array(
				"item_id"      => $arr1[$i]["item_id"],
				"item_name"    => $arr1[$i]["item_name"],
				"item_onset"   => $arr1[$i]["item_onset"],
				"types"        => array(
					array(
						"item_type_id" => $arr1[$i]["item_type_id"],
						"type_id"      => $arr1[$i]["type_id"],
						"type_name"    => $arr1[$i]["type_name"]
					)
				)
			));
		}
	}
	
	header('Content-type: application/json');
	echo json_encode($narr1, JSON_PRETTY_PRINT);
?>
