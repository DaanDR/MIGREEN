// window.onload = function addField() {
//     console.log("success");
// 	document.getElementById("add-field").innerHTML = '<select name="customername" required>';
    // + "<optgroup label='Kies een klant'>" +
    // "<option selected hidden>Kies een klant</option>" +
    // "</optgroup>" +
    // "</select>" +
    // "<div class='buttons-right'>" +
    // "<button onclick='addField()' type='button' name='add' id='add' class='btn btn-info'><img src='../res/add.svg'></button>" +
    // "</div>";
// }

function myFunction() {
    var itm = document.getElementById("myList2").lastChild;
    var cln = itm.cloneNode(true);
    document.getElementById("myList1").appendChild(cln);
}