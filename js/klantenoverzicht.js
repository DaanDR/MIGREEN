const newCustomerButton = document.getElementById("new-customer-button");
const editButtons = document.getElementsByClassName("editbutton");
const deleteButtons = document.getElementsByClassName("deletebutton");
const createButton = document.getElementById("createButton");


newCustomerButton.onclick = function() {
	var customertable = document.getElementById("customerTable");
	var createcustomer = document.getElementById("createCustomer");
	customertable.style.display = "none";
	createcustomer.style.display = "block";
}


for (var i = 0; i < editButtons.length; i++){
	var editButton = editButtons[i];
	editButton.onclick = function() {
		var customertable = document.getElementById("customerTable");
		var createcustomer = document.getElementById("createCustomer");
		customertable.style.display = "none";
		createcustomer.style.display = "block";
	}
}

for (var i = 0; i < deleteButtons.length; i++){
	var deleteButton = deleteButtons[i];
	deleteButton.onclick = function() {
		var customertable = document.getElementById("customerTable");
		var createcustomer = document.getElementById("createCustomer");
		customertable.style.display = "none";
		createcustomer.style.display = "block";
	}
}

function stringTooShort(){
	alert("Een klantnaam moet minimaal 2 karakters bevatten!");
	hideCustomers();
}

function hideCustomers(){
	var customertable = document.getElementById("customerTable");
	var createcustomer = document.getElementById("createCustomer");
	customertable.style.display = "none";
	createcustomer.style.display = "block";
}
