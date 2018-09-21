console.log('test');

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:

    document.getElementById("prevBtn").onclick = function(){nextPrev(-1)};
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Opslaan";
    } else {
        document.getElementById("nextBtn").innerHTML = "Volgende stap";
        document.getElementById("prevBtn").innerHTML = "Vorige stap";
    }

    if (n == 0) {
        document.getElementById("prevBtn").style.display = "inline";
        document.getElementById("prevBtn").innerHTML = "Annuleren";
        document.getElementById("prevBtn").onclick = function (){
            if(confirm('Weet u het zeker ? ')){
                window.location.href = 'omgevingsoverzicht.php', target="_self";

            }
        };
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    var a = document.getElementsByClassName("step");
    var b = document.getElementsByClassName("step-title");
    var c = document.getElementsByClassName("progressbar-line");
    var PreviousTab;
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    PreviousTab = currentTab - n;
    if (n == -1) {
        a[PreviousTab].className = a[currentTab].className.replace(" active", "");
        b[PreviousTab].className = b[currentTab].className.replace(" active", "");
        if (PreviousTab <= 1) {
            c[0].className = c[0].className.replace(" active", "");
            console.log("Deactivating line of c 0");
        } else {
            c[1].className = c[1].className.replace(" active", "");
            console.log("Deactivating line of c 1");

        }

        // showTabWithoutFix(currentTab);
    }
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var x = document.getElementsByClassName("step");
    var y = document.getElementsByClassName("step-title");
    var z = document.getElementsByClassName("progressbar-line");

    //... and adds the "active" class on the current step:
    if (x[n].classList.contains("active") == false) {
        x[n].className += " active";
    } else {
        x[n].className += "";
    }
    if (y[n].classList.contains("active") == false) {
        y[n].className += " active";
    } else {
        y[n].className += "";
    }
    if (currentTab == 0 && z[0].classList.contains("active") == false) {
        // z[0].className += " active";
    } else if (currentTab == 1 && z[0].classList.contains("active") == false && z[1].classList.contains("active") == false) {
        z[0].className += " active";
        console.log("z 0 does not contains active. Making it active")
    } else if (currentTab == 2 && z[1].classList.contains("active") == false) {
        z[1].className += " active";
        console.log("z 1 does not contains active. Making it active")

    }

}


