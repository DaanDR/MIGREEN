const newCustomerButton = document.getElementById("new-customer-button");
const editButtons = document.getElementsByClassName("editbutton");
const deleteButtons = document.getElementsByClassName("deletebutton");

newCustomerButton.onclick = function() {
	if (confirm('Wil je een nieuwe klant aanmaken?')) {
		return true;
	} else {
		return false;
	}
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
