function confirmDelete(naam) {
  if (confirm('Weet u zeker dat u ' + naam + ' wilt verwijderen?')) {
    return true;	
  } else{
    return false;
  }
}

function notDeleteSelf() {
  window.location.replace(overzicht.php);    
  alert("Je kunt niet jezelf verwijderen, dummy ;)");
}