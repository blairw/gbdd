var allItems = [];
function bodyDidLoad() {
	loadAllItems();
	$("#enterText").focus();
}
function loadAllItems() {
	var allItemsString = $.get("svc-getItems.php", function(data) {
		allItems = data;
		$("#statusbar").html(
			"Loaded " + data.length + " items. "
			+ "<a href='svc-getItems.php' target='_blank'>See API?</a>"
		);
		$("#statusbar").css("background-color", "green");
		console.log(allItems);
	});
}

function processText() {
	var textInput = $("#enterText").val().toLowerCase();
	$("#myOutput").html("");
	
	if (textInput != "") {
		var areItemsFound = false;
		for (var i = 0; i < allItems.length; i++) {
			var thisItemMatches = false;
			var thisItemTypes = [];
			
			if (allItems[i].item_name.toLowerCase().search(textInput) != -1) {
				thisItemMatches = true;
			} else if (allItems[i].types.length > 0) {
				for (var j = 0; j < allItems[i].types.length; j++) {
					if (allItems[i].types[j].type_name.toLowerCase().search(textInput) != -1) {
						thisItemMatches = true;
					}
				}
			}
			
			if (thisItemMatches) {
				for (var j = 0; j < allItems[i].types.length; j++) {
					thisItemTypes.push(allItems[i].types[j].type_name);
				}
				areItemsFound = true;
				$("#myOutput").append(
					"<div class='itemCard'>"
					+ "<h2 class='itemTitle'>" + allItems[i].item_name + "</h2>"
					+ (thisItemTypes.length > 0 ? "Types: <span class='itemTypes'>" + thisItemTypes.join(", ") : "") + "</span>"
					+ "</div>"
				);
			}
		}
		if (!areItemsFound) {
			$("#myOutput").html("<div class='noItemsFound'>No items found.</div>");
		}
	}
	
	$(".itemTitle").highlight(textInput);
	$(".itemTypes").highlight(textInput);
}
