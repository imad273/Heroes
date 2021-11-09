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


let openMenuBtn = document.getElementById("menu-btn");
let nav = document.getElementById("nav");
let exit = document.getElementById("exit");

if(openMenuBtn !== null) {
   openMenuBtn.addEventListener("click", () => {
      nav.style.transform = "translateX(0%)";
   })
   exit.addEventListener("click", () => {
      nav.style.transform = "translateX(100%)";
   })
}