console.log("test");

var n = 0;

function showPopup(){

  if(n == 0) {
  var x =  document.getElementsByClassName("hidden");
  x[0].className = x[0].className.replace("hidden","show");
  n = 1;
} else if(n == 1) {
  var x =  document.getElementsByClassName("show");
  x[0].className = x[0].className.replace("show", "hidden");
  n = 0;
}
  // n += 1;

// console.log(x);

  // x.className = x.className.replace("hidden","show");

}



function HidePopup(){

  var x =  document.getElementsByClassName("show");
  var n = 0;
  x[n].className = x[0].className.replace("show", "hidden");
  // n += 1;

// console.log(x);

  // x.className = x.className.replace("hidden","show");

}
