
// This is the AJAX for index.php
function loadDoc(url, cFunction) {
    var xhr;
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cFunction(this); // myFunction(this) || "(this)" returns XMLHttpRequest Object, which after executed
        }
    };
    xhr.open("GET", url, true);
    xhr.send();
}
function displayOne(xhr) {
    document.getElementById("display").className += " border3";
    document.getElementById("display").innerHTML = xhr.responseText;
    loadDoc("PHPs/imbed.blankpage.php", displayTwo);
}
function displayTwo(xhr) {
    document.getElementById("display2").className += " border3";
    document.getElementById("display2").innerHTML = xhr.responseText;
    loadDoc("PHPs/imbed.blankpage.php", displayThree);
}
function displayThree(xhr) {
    document.getElementById("display3").className += " border3";
    document.getElementById("display3").innerHTML = xhr.responseText;
}
