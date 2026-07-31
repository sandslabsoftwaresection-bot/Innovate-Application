"use strict";

$(document).ready(function () {
    
	
	var options = {
    data: [
		{item_name:"Item 1"},
        {item_name:"Item 2"},
		{item_name:"Item 3"},
        // Add more items as needed
    ],
    getValue: "item_name",
    list: {
        match: {
            enabled: true,
        },
    },
};


$("#txt_item_name").easyAutocomplete(options);

	 $("#txt_item_name").on("keyup", function () {
		 
	
    var inputText = $(this).val();
    //alert(inputText);

    // Send an AJAX request to fetch data 
    $.post("../controller/inventory/inventory_controller.php", { action: 'fetch_item', v_item_name: inputText }, function (result, status) {
        console.log(options);

      
        // Update the data property of your easyAutocomplete instance
        options.data = result;

        // Refresh the easyAutocomplete dropdown with new data
        $("#txt_item_name").easyAutocomplete(options);
    });
	
		
	
});
 
	
});