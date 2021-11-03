var cntrl = document.getElementsByClassName("cntrl");
var cont = document.getElementsByClassName("cont");


/* for(let i = 0; i < cont.length; i++) {
   cont[i].addEventListener("mouseover", function(e) {
      cntrl[i].style.display = "flex";
   })

   cont[i].addEventListener("mouseout", function(e) {
      cntrl[i].style.display = "none";
   })
} */



function showControl(elm) {
   elm.children[0].style.opacity = "1";
   //elm.children[0].style.display = "flex";
}
function hideControl(elm) {
   elm.children[0].style.opacity = "0";
   //elm.children[0].style.display = "none";
}