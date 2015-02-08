var allItems = [];
var allTypes = [];

function bodyDidLoad() {
	loadAllItems();
}
function loadAllItems() {
	// select2
	$("#selectAssociatedTypes").select2({
		placeholder: "Associated types"
	});
	
	var allTypesString = $.get("svc-getTypes.php?grouping=child", function(data) {
		allTypes = _.sortBy(data, function(datum){ return datum.child_name; });
		
		for (var i = 0; i < allTypes.length; i++) {
			$("#selectAssociatedTypes").append(
				"<option value='" + allTypes[i].child_id + "'>" + allTypes[i].child_name + "</option>"
			);
		}
	});
	
	var allItemsString = $.get("svc-getItems.php", function(data) {
		allItems = data;
		$("#statusbar").html(
			"<span class='fa fa-check-circle'></span>&nbsp;&nbsp;Loaded " + data.length + " items. "
			+ "<a href='svc-getItems.php' target='_blank'>See API?</a>"
		);
		$("#statusbar").css("background-color", "green");
		
		// populate table
		var thisItemTypeNames = [];
		for (var i = 0; i < allItems.length; i++) {
			thisItemTypeNames = [];
			if (allItems[i].types) {
				for (var j = 0; j < allItems[i].types.length; j++) {
					thisItemTypeNames.push(allItems[i].types[j].type_name);
				}
			}
			$("#itemsTbody").append(
				"<tr><td>" + allItems[i].item_id
				+ "</td><td>" + allItems[i].item_name
				+ "</td><td>" + "<button class='100percented btn btn-sm btn-primary' onclick='editModalShow()'>EDIT</button>"
				+ "</td></tr>"
			);
		}
		// insert new item line (row)
		$("#itemsTbody").append(
			"<tr><td>" + "<em>New line:</em>"
			+ "</td><td>" + "<input type='text' class='form-control' placeholder='New item name' />"
			+ "</td><td>" + "<button class='100percented btn btn-sm btn-success'><span class='fa fa-upload'></span>&nbsp;&nbsp;SAVE</button>"
			+ "</td></tr>"
		);
		
	}); // that's all that will get executed upon load of data!
}
function editModalShow() {
	$("#editModal").modal("show");
}
