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
		<link rel="stylesheet" href="frameworks/font-awesome-4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="style.css">
	</head>
	<body class="wide" onload="bodyDidLoad()">
		<div class="modal" id="editModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<p>
						<label>Item Name</label>
						<input type="text" class="form-control" placeholder="Item name" />
						</p>
						<p>
						<label>Onset</label>
						<select class="form-control">
							<option>Chronic</option>
						</select>
						</p>
						<p>
						<label>Associated Types</label>
						<input type="text" class="form-control" placeholder="Associated types" />
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<h1>gbdd Control Panel</h1>
		<div id="statusbar"><span class='fa fa-refresh fa-spin'></span>&nbsp;&nbsp;Loading data...</div>
		<h2>Items</h2>
		<table id="itemsTable" class="table table-striped table-bordered">
			<tbody id="itemsTbody">
				<tr><th>Item ID</th><th>Item Name</th><th>Associated Types</th><th>Manage</th></tr>
			</tbody>
		</table>
	</body>
</html>
