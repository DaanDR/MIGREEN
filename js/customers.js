// Variabele om de klant aanmaken knop op de pagina te vinden
const newCustomerButton = document.getElementById("new-customer-button");

// Functie voor de klant aanmaken knop
newCustomerButton.onclick = function() {
	window.open("../klantbeheer/createcustomer.php", "_self");
}

// Waarschuwing bij het aanmaken van een klant (minimaal 2 karakters)
function stringTooShort(){
	alert("Een klantnaam moet minimaal 2 karakters bevatten!");
}

// Waarschuwing bij het aanmaken van een klant (geen spaties)
function noSpaces(){
	alert("Een klantnaam mag geen spaties bevatten!");
}
