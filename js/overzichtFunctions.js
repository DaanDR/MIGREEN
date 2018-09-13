function confirmDelete(naam) {
  if (confirm('Weet u zeker dat u ' + naam + ' wilt verwijderen?')) {
    return true;	
  } else{
    return false;
  }
}