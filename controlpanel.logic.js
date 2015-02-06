var allItems = [];
function bodyDidLoad() {
	loadAllItems();
}
function loadAllItems() {
	var allItemsString = $.get("svc-getItems.php", function(data) {
		allItems = data;
		$("#statusbar").html(
			"Loaded " + data.length + " items. "
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
				+ "</td><td>" + thisItemTypeNames.join(", ")
				+ "</td><td>" + "<button class='btn btn-sm btn-primary'>EDIT</button>"
				+ "</td></tr>"
			);
		}
		$("#itemsTbody").append(
			"<tr><td>" + "<em>New line:</em>"
			+ "</td><td>" + "<input type='text' class='form-control' placeholder='New item name' />"
			+ "</td><td>" + "<input type='text' class='form-control' placeholder='New item types' />"
			+ "</td><td>" + "<button class='btn btn-sm btn-success'>SAVE</button>"
			+ "</td></tr>"
		);
	});
}
