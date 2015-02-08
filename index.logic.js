var allItems = [];
function bodyDidLoad() {
	loadAllItems();
	$("#enterText").focus();
}
function loadAllItems() {
	var allItemsString = $.get("svc-getItems.php", function(data) {
		allItems = data;
		$("#statusbar").html(
			"<span class='fa fa-check-circle'></span>&nbsp;&nbsp;Loaded " + data.length + " items. "
			+ "<a href='svc-getItems.php' target='_blank'>See API?</a>"
		);
		$("#statusbar").css("background-color", "green");
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
			
			// search logic
			if (allItems[i].item_name.toLowerCase().search(textInput) != -1) {
				// checking item name
				thisItemMatches = true;
				
			} else if (allItems[i].item_onset != null && allItems[i].item_onset.toLowerCase().search(textInput) != -1) {
				// checking item onset
				thisItemMatches = true;
				
			} else if (allItems[i].types.length > 0) {
				// checking each item type
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
					"<div class='panel panel-default'>"
					+ "<div class='panel-body itemCard'>"
					+ "<h2 class='itemTitle'>" + allItems[i].item_name + "</h2>"
					+ (thisItemTypes.length > 0 ? "Types: <span class='itemTypes'>" + thisItemTypes.join(", ") : "") + "</span>"
				    + (allItems[i].item_onset ? "<div>Onset: <span class='itemOnset'>" + allItems[i].item_onset + "</span></div>" : "")
					+ "</div>"
					+ "</div>"
				);
			}
		}
		if (!areItemsFound) {
			$("#myOutput").html("<div class='noItemsFound'>No items found.</div>");
		}
	}
	
	// highlight search term in searched areas of each item
	$(".itemTitle").highlight(textInput);
	$(".itemTypes").highlight(textInput);
	$(".itemOnset").highlight(textInput);
}
