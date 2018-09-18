const newCustomerButton = document.getElementById("new-customer-button");
const editButtons = document.getElementsByClassName("editbutton");
const deleteButtons = document.getElementsByClassName("deletebutton");
const createButton = document.getElementById("createButton");
const names = document.getElementsByClassName("klantnaam");


newCustomerButton.onclick = function() {
	window.location("../klantbeheer/createcustomer.php");
}


for (var i = 0; i < editButtons.length; i++){
	var editButton = editButtons[i];
	var name = names[i];
	editButton.onclick = function() {
		document.getElementById("customerName").value = name;
		var customertable = document.getElementById("customerTable");
		var createcustomer = document.getElementById("createCustomer");
		customertable.style.display = "none";
		createcustomer.style.display = "block";
	}
}

for (var i = 0; i < deleteButtons.length; i++){
	var deleteButton = deleteButtons[i];
	deleteButton.onclick = function() {
		var check = confirm("Wil je deze klant verwijderen?");
		if (check == true) {
			
		} else {
			alert("Klant niet verwijderd");
		}
	}
}

function stringTooShort(){
	hideCustomers();
	alert("Een klantnaam moet minimaal 2 karakters bevatten!");
}

function hideCustomers(){
	var customertable = document.getElementById("customerTable");
	var createcustomer = document.getElementById("createCustomer");
	customertable.style.display = "none";
	createcustomer.style.display = "block";
}
