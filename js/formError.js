console.log("");

function formErrorPassword() {
  // console.log("Wachtwoord is niet gelijk!");
  // document.getElementByClass("password-errormessage").innerHTML = "De wachtwoorden komen niet overeen, stupid!";
}

function formErrorUsername() {
  document.getElementByClassName("username-errormessage").innerHTML = "Deze gebruiker bestaat al!";
}
