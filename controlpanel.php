<!DOCTYPE html>
<html>
	<head>
		<title>gbdd control panel</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="frameworks/jquery-1.11.2.min.js"></script>
		<script src="frameworks/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
		<script src="controlpanel.logic.js"></script>
		<link rel="stylesheet" href="frameworks/bootstrap-3.3.2-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
	</head>
	<body class="wide" onload="bodyDidLoad()">
		<h1>gbdd Control Panel</h1>
		<div id="statusbar">Loading data...</div>
		<h2>Items</h2>
		<table id="itemsTable" class="table table-striped table-bordered">
			<tbody id="itemsTbody">
				<tr><th>Item ID</th><th>Item Name</th><th>Associated Types</th><th>Manage</th></tr>
			</tbody>
		</table>
	</body>
</html>
