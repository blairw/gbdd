<!DOCTYPE html>
<html>
	<head>
		<title>gbdd control panel</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--jquery-->
		<script src="frameworks/jquery-1.11.2.min.js"></script>
		<!--bootstrap-->
		<script src="frameworks/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="frameworks/bootstrap-3.3.2-dist/css/bootstrap.min.css">
		<!--select2-->
		<script src="frameworks/select2-3.5.2/select2.min.js"></script>
		<link rel="stylesheet" href="frameworks/select2-3.5.2/select2.css" />
		<link rel="stylesheet" href="frameworks/select2-3.5.2/select2-bootstrap.css" />
		<!--font-awesome-->
		<link rel="stylesheet" href="frameworks/font-awesome-4.3.0/css/font-awesome.min.css">
		<!--underscore-->
		<script src="frameworks/underscore-min.js"></script>
		<!--gbdd-->
		<script src="controlpanel.logic.js"></script>
		<link rel="stylesheet" href="style.css">
	</head>
	<body onload="bodyDidLoad()">
		<div class="modal" id="editModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<p>
						<label>Item Name</label>
						<input id="inputItemName" type="text" class="form-control" placeholder="Item name" />
						</p>
						<p>
						<label>Onset</label>
						<input id="inputItemOnset" type="text" class="form-control" placeholder="Item onset" />
						</p>
						<p>
						<label>Associated Types</label>
						<select id="selectAssociatedTypes" class="form-control select2" multiple="multiple">
							<option></option>
						</select>
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary" disabled>Save changes</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<div class="gbddWrapper wide">
			<h1>gbdd Control Panel</h1>
			<div id="statusbar"><span class='fa fa-refresh fa-spin'></span>&nbsp;&nbsp;Loading item types ...</div>
			<h2>Items</h2>
			<table id="itemsTable" class="table table-striped table-bordered">
				<tbody id="itemsTbody">
					<tr><th class="col-md-2">Item ID</th><th class="col-md-8">Item Name</th><th class="col-md-2">Manage</th></tr>
				</tbody>
			</table>
		</div>
	</body>
</html>
