function deleteask()
{
  if (confirm('Wil je zeker weten uitloggen?')){
    return true;
  }else{
    return false;
  }
}

document.getElementById("buttOkLogOut").addEventListener("click",
function()
{
    window.location.href = document.getElementById("error_message_url").value;
    
   // "http://localhost/guido/mybit/migreen/header/header.php?action=logout&logoutinfo=1";
});


var objCancel = document.getElementById("buttCancel");
objCancel.addEventListener("click",
        function()
        {
            var objErrM = document.getElementsByClassName("error-message-container");
            var objErrB = document.getElementsByClassName("error-message-backgr");

            for (var index = 0; index < objErrM.length; index++) 
            {
                objErrM[index].style.display = "none";
                objErrB[index].style.display = "none";
            }
    });