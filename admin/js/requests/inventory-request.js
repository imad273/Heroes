/* 
   * Toggle between categories 
*/

var cats = document.getElementsByClassName("cats");
var btn = document.getElementById("dropdownMenuBtn");
var tbody = document.getElementById("tbody");

for (var i = 0; i < cats.length; i++) {
   cats[i].addEventListener("click", (e) => {
      var cat_id = e.target.attributes[0].value;

      let request = new XMLHttpRequest();
      let form = new FormData();

      form.append("cat_id", cat_id);

      request.open("POST", "././Controllers/InventoryControl.php?action=category");

      request.onreadystatechange = () => {
         if (request.readyState === 4 && request.status === 200) {
            tbody.innerHTML = request.responseText;
            if (cat_id == 0) {
               btn.innerHTML = "Select Category ";
            } else {
               btn.innerHTML = e.target.innerText;
            }
         }
      }

      request.send(form);
   })
}

/* Search Fueture */
var searchField = document.getElementById("search-ipt");
if (searchField != null) {
   searchField.addEventListener("input", () => {
      let request = new XMLHttpRequest();
      let form = new FormData();

      form.append("keyword", searchField.value);

      request.open("POST", "././Controllers/InventoryControl.php?action=search");

      request.onreadystatechange = () => {
         if (request.readyState === 4 && request.status === 200) {
            tbody.innerHTML = request.responseText;
         }
      }

      request.send(form);
   })
}


function deleteItem(id) {

   var alertMsg = document.getElementById("conf-alert");
   var cancel = document.getElementById("cancelBtn");
   var yesBtn = document.getElementById("yesBtn");
   var Catbtn2 = document.getElementById("dropdownMenuBtn");
   
   var itemId = id;
   alertMsg.style.display = "flex";

   yesBtn.addEventListener("click", () => {
      let request = new XMLHttpRequest();
      let form = new FormData();

      form.append("itemId", itemId);

      request.open("POST", "././Controllers/InventoryControl.php?action=delete");

      request.onreadystatechange = () => {
         if (request.readyState === 4 && request.status === 200) {
            alertMsg.style.display = "none";
            tbody.innerHTML = request.responseText;
            Catbtn2.innerHTML = "Select Category ";
         }
      }

      request.send(form);
   })

   cancel.addEventListener("click", () => {
      alertMsg.style.display = "none";
   }) 
}

/* 

   * Edit Item Request

*/
var editBtn = document.getElementById("submit-edit");
var inputs = document.getElementsByClassName("form-control");
// Categories Choise
var cats = document.getElementsByClassName("cats-edit");
var catBtn = document.getElementById("catBtn");

// Get the new Category if the user change it
for (let i = 0; i < cats.length; i++) {
   cats[i].addEventListener("click", function () {
      catId = this.attributes[0].value;
      catBtn.setAttribute("data", catId);
      catBtn.innerHTML = this.innerHTML;
   })
}



/* 
   * Failed And Success Message
*/

var alertMsg = document.querySelector("#alert");

function sayError(msg) {
   if (msg != null) {
      alertMsg.style.display = "block";
      alertMsg.className = "alert-err";
      alertMsg.childNodes[1].innerHTML = "<i class='bx bxs-error'></i> " + msg;
      alertMsg.childNodes[1].setAttribute('id', "err-msg");
   } 
}

function saySuccess(msg) {
   if (msg != null) {
      alertMsg.style.display = "block";
      alertMsg.className = "alert-suc";
      alertMsg.childNodes[1].innerHTML = "<i class='bx bx-list-check'></i> " + msg;
      alertMsg.childNodes[1].setAttribute('id', "suc-msg");
   }
}

// Send The edit Request
if (editBtn !== null) {
   editBtn.addEventListener("click", () => {
      let request = new XMLHttpRequest();
      let form = new FormData();

      // Set All the input's value in the form
      for (let i = 0; i < inputs.length; i++) {
         form.append(inputs[i].name, inputs[i].value);
      }

      // append the category
      form.append("cat", catBtn.attributes[3].value);

      // Get the query string of id in the link to identify each items
      const urlSearchParams = new URLSearchParams(window.location.search);
      const params = Object.fromEntries(urlSearchParams.entries());
      form.append("id", params.id);

      request.open("POST", "././Controllers/InventoryControl.php?action=edit");

      request.onreadystatechange = () => {
         if (request.readyState === 4 && request.status === 200) {
            // Success
            if(request.responseText == "succ") {
               saySuccess("Data Saved");
               window.scrollTo("0", "0");
            } else {
               // Failed
               sayError(request.responseText);
               window.scrollTo("0", "0");
            }
         }
      }

      request.send(form);
   })
}


// Edit Images
var ediItmgBtns = document.getElementsByClassName("edit-btns");
var file = document.getElementsByClassName("img");
let rowImgs = document.getElementById("imgs-row");
var srcOfNewImg;
let position;


function editImg() {
   for(let i = 0; i < file.length; i++) {
      file[i].addEventListener("input", () => {
         position = i;
         srcOfNewImg = file[i].files[0];

         let request = new XMLHttpRequest();
         let form = new FormData();

         form.append("img", srcOfNewImg);
         form.append("posImg", position);

         const urlSearchParams = new URLSearchParams(window.location.search);
         const params = Object.fromEntries(urlSearchParams.entries());
         form.append("id", params.id);

         request.open("POST", "././Controllers/InventoryControl.php?action=edit-img");

         request.onreadystatechange = () => {
            if (request.readyState === 4 && request.status === 200) {
               rowImgs.innerHTML = request.responseText;
            }
         }

         request.send(form);
      })
   }
}