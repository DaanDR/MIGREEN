function confirmDelete() {
  if (confirm('Weet u zeker dat u deze gebruiker wilt verwijderen?')) {
    return true;	
  } else{
    return false;
  }
}