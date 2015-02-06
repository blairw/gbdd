<?php
	$validApiUsage = false;
	$grouping = (isset($_GET["grouping"]) ? $_GET["grouping"] : null);
	
	// database read
	include("../gbdd_dbconfig/dbconfig.php");
	$mysqli = new mysqli($MYSQL_DBSERVER, $MYSQL_USERNAME, $MYSQL_PASSWORD, $MYSQL_DATABASE);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	if ($grouping == "parent" || $grouping == "child") {
		$res1 = $mysqli->query("
		select 
			r.type_relo_id AS tr_id,
			c.type_id AS child_id,
			c.type_name AS child_name,
			p.type_id AS parent_id,
			p.type_name AS parent_name
		from
			blairwan_blairdb.gbdd_types c
			left join blairwan_blairdb.gbdd_type_relo r ON c.type_id = r.type_id_child
			left join blairwan_blairdb.gbdd_types p ON p.type_id = r.type_id_parent
		");
		$validApiUsage = true;
	}
	
	if ($validApiUsage) {
		$counter = 0;
		while ($row1 = $res1->fetch_assoc()) {
			$arr1[$counter] = $row1;
			$counter++;
		}
		$res1->close();
		$mysqli->close();
	}
	
	// cleanup arrays
	if ($grouping == "parent") { // parent mode
		$narr1 = [];
		for ($i = 0; $i < count($arr1); $i++) {
			// first try add children to existing
			$found = false;
			for ($j = 0; $j < count($narr1); $j++) {
				if ($narr1[$j]["parent_id"] == $arr1[$i]["parent_id"]) {
					array_push($narr1[$j]["children"], array(
						"tr_id"      => $arr1[$i]["tr_id"],
						"child_id"   => $arr1[$i]["child_id"],
						"child_name" => $arr1[$i]["child_name"]
					));
					$found = true;
				}
			}
			// if no existing then create new and add children if applicable
			if (!$found) {
				array_push($narr1, array(
					"parent_id"    => $arr1[$i]["parent_id"],
					"parent_name"  => $arr1[$i]["parent_name"]
				));
				if ($arr1[$i]["child_id"]) {
					$narr1[count($narr1)-1]["children"] = [];
					array_push($narr1[count($narr1)-1]["children"], array(
						"tr_id"      => $arr1[$i]["tr_id"],
						"child_id"   => $arr1[$i]["child_id"],
						"child_name" => $arr1[$i]["child_name"]
					));
				}
			}
		}
	} else if ($grouping == "child") { // child mode
		$narr1 = [];
		for ($i = 0; $i < count($arr1); $i++) {
			$found = false;
			for ($j = 0; $j < count($narr1); $j++) {
				if ($narr1[$j]["child_id"] == $arr1[$i]["child_id"]) {
					array_push($narr1[$j]["parents"], array(
						"tr_id"       => $arr1[$i]["tr_id"],
						"parent_id"   => $arr1[$i]["parent_id"],
						"parent_name" => $arr1[$i]["parent_name"]
					));
					$found = true;
				}
			}
			if (!$found) {
				array_push($narr1, array(
					"child_id"    => $arr1[$i]["child_id"],
					"child_name"  => $arr1[$i]["child_name"]
				));
				if ($arr1[$i]["parent_id"]) {
					$narr1[count($narr1)-1]["parents"] = [];
					array_push($narr1[count($narr1)-1]["parents"], array(
						"tr_id"       => $arr1[$i]["tr_id"],
						"parent_id"   => $arr1[$i]["parent_id"],
						"parent_name" => $arr1[$i]["parent_name"]
					));
				}
			}
		}
	}
	
	header('Content-type: application/json');
	if ($validApiUsage) {
		echo json_encode($narr1, JSON_PRETTY_PRINT);
	}
?>
