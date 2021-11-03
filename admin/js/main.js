var cntrl = document.getElementsByClassName("cntrl");
var cont = document.getElementsByClassName("cont");

// Show The Edit Button In Edit Image Page
function showControl(elm) {
   elm.children[0].style.opacity = "1";
}

// Hide The Edit Button In Edit Image Page
function hideControl(elm) {
   elm.children[0].style.opacity = "0";
}