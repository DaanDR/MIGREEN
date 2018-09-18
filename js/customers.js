const newCustomerButton = document.getElementById("new-customer-button");
const editButtons = document.getElementsByClassName("editbutton");
const deleteButtons = document.getElementsByClassName("deletebutton");
const createButton = document.getElementById("createButton");
const names = document.getElementsByClassName("klantnaam");


newCustomerButton.onclick = function() {
	window.open("../klantbeheer/createcustomer.php", "_self");
}

function stringTooShort(){
	alert("Een klantnaam moet minimaal 2 karakters bevatten!");
}

function noSpaces(){
	alert("Een klantnaam mag geen spaties bevatten!");
}

function customerDeleted(name){
	alert("Klant " + name + " is verwijderd");
}

function existingCustomer(name){
	alert("Klant " + name + " bestaat al in de database!");
}
