const newCustomerButton = document.getElementById("new-customer-button");
const editButtons = document.getElementsByClassName("editbutton");
const deleteButtons = document.getElementsByClassName("deletebutton");
const createButton = document.getElementById("createButton");
const removeButton = document.getElementById("removeButton");

createButton.onclick = function(){
	alert ('Nieuwe Klant Aanmaken');
}

removeButton.onclick = function(){
	alert ('Klant verwijderen');
}

newCustomerButton.onclick = function() {
	var customertable = document.getElementById("customerTable");
	var createcustomer = document.getElementById("createCustomer");
	customertable.style.display = "none";
	createcustomer.style.display = "block";
}


for (var i = 0; i < editButtons.length; i++){
	var editButton = editButtons[i];
	editButton.onclick = function() {
		alert ('LET OP! Hiermee pas je een klant aan!')
	}
}

for (var i = 0; i < deleteButtons.length; i++){
	var deleteButton = deleteButtons[i];
	deleteButton.onclick = function() {
		alert ('PAS OP! Hiermee verwijder je een klant!')
	}
}
