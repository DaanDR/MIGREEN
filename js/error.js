
var objClose = document.getElementsByClassName("close");

for (let index = 0; index < objClose.length; index++) 
{
    objClose[index].addEventListener("click",
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
}