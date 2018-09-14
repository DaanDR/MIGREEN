function confirmDelete(naam) {
  if (confirm('Weet u zeker dat u ' + naam + ' wilt verwijderen?')) {
    return true;	
  } else{
    return false;
  }
}

function notDeleteSelf() {
  alert("Je kunt niet jezelf verwijderen, dummy. Je gaat nu weer terug naar Gebruikersoverzicht.");
  window.location.replace('overzicht.php');    
}