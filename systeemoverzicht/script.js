console.log("test");

var n = 0;

function showPopup(z){

  if(n == 0) {
  var x =  document.getElementsByClassName("hidden");
  var b =  document.getElementsByClassName("info-container");
  x[0].className = x[0].className.replace("hidden","show");
  if(z == 2 ) {
    b[0].innerHTML = "<img class='system-image' src='../res/systeem2.jpg'>";
  } else if( z == 1) {
    b[0].innerHTML = "<img class='system-image' src='../res/systeem1.jpg'>";
  } else if( z == 3) {
    b[0].innerHTML = "<img class='system-image' src='../res/systeem3.jpg'>";
  }
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
