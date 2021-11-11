
var alertMsg = document.querySelector("#alert");

// Error Message
function sayError(msg) {
   if (msg != null) {
      alertMsg.style.display = "block";
      alertMsg.className = "alert-err";
      alertMsg.childNodes[1].innerHTML = "<i class='bx bxs-error'></i> " + msg;
      alertMsg.childNodes[1].setAttribute('id', "err-msg");
   } 
}

// Success Message
function saySuccess(msg) {
   if (msg != null) {
      alertMsg.style.display = "block";
      alertMsg.className = "alert-suc";
      alertMsg.childNodes[1].innerHTML = "<i class='bx bx-list-check'></i> " + msg;
      alertMsg.childNodes[1].setAttribute('id', "suc-msg");
   }
}

/* 
   * Toggle between categories 
*/

var categories = document.getElementsByClassName("cats");
var categoryBtn = document.getElementById("dropdownMenuBtn");
var tbody = document.getElementById("tbody");

for (var i = 0; i < categories.length; i++) {
   categories[i].addEventListener("click", (e) => {
      var categoryId = e.target.attributes[0].value;

      let request = new XMLHttpRequest();
      let form = new FormData();
      
      form.append("cat_id", categoryId);
      
      // Open http request
      request.open("POST", "././Controllers/Inventory.controller.php?action=category");

      request.onreadystatechange = () => {
         if (request.readyState === 4 && request.status === 200) {
            // Output The Response In The Table
            tbody.innerHTML = request.responseText;

            // If No Category Selected
            if (categoryId == 0) {
               categoryBtn.innerHTML = "Select Category ";
            } else {
               // Else Print The Selected category
               categoryBtn.innerHTML = e.target.innerText;
            }
         }
      }

      // Send the request with form
      request.send(form);
   })
}

/* 
   * Search Function 
*/

var searchField = document.getElementById("search-ipt");
var categoryBtn2 = document.getElementById("dropdownMenuBtn");

// ! I Checked If There Is Search Input Because This File Is Used In More Than Page //
if (searchField != null) {
   searchField.addEventListener("input", () => {
      
      let request = new XMLHttpRequest();
      let form = new FormData();

      form.append("keyword", searchField.value);

      // Open http request
      request.open("POST", "././Controllers/Inventory.controller.php?action=search");
      
      request.onreadystatechange = () => {
         if (request.readyState === 4 && request.status === 200) {
            // Output The Response In The Table
            tbody.innerHTML = request.responseText;
            categoryBtn2.innerHTML = "Select Category ";
         }
      }

      // Send the request with form
      request.send(form);
   })
}

/*
   * Delete Function
*/

function deleteItem(id) {
   var alertMsg = document.getElementById("conf-alert");
   var cancel = document.getElementById("cancelBtn");
   var yesBtn = document.getElementById("yesBtn");
   var categoryBtn3 = document.getElementById("dropdownMenuBtn");
   
   var itemId = id;
   alertMsg.style.display = "flex";

   // If The User Click On Yes Button Send The Request
   yesBtn.addEventListener("click", () => {
      let request = new XMLHttpRequest();
      let form = new FormData();

      form.append("itemId", itemId);

      // Open http request
      request.open("POST", "././Controllers/Inventory.controller.php?action=delete");

      request.onreadystatechange = () => {
         if (request.readyState === 4 && request.status === 200) {
            alertMsg.style.display = "none";

            // Print The Remaining Items
            tbody.innerHTML = request.responseText;
            categoryBtn3.innerHTML = "Select Category ";
         }
      }

      // Send the request with form
      request.send(form);
   })

   cancel.addEventListener("click", () => {
      // If The User Click In Cancel Button Hide The Alert
      alertMsg.style.display = "none";
   }) 
}

/* 
   * Edit Item Request
*/
var saveBtn = document.getElementById("submit-edit");
var inputs = document.getElementsByClassName("form-control");
// Categories Choise
var categories = document.getElementsByClassName("cats-edit");
var categoryBtn4 = document.getElementById("catBtn");

// Get the new Category if the user change it
for (let i = 0; i < categories.length; i++) {
   categories[i].addEventListener("click", function () {
      catId = this.attributes[0].value;
      categoryBtn4.setAttribute("data", catId);
      categoryBtn4.innerHTML = this.innerHTML;
   })
}

/* 
   * Failed And Success Message
*/



// Send The edit Request
if (saveBtn !== null) {
   saveBtn.addEventListener("click", () => {
      let request = new XMLHttpRequest();
      let form = new FormData();

      for (let i = 0; i < inputs.length; i++) {
         form.append(inputs[i].name, inputs[i].value);
      }

      form.append("cat", categoryBtn4.attributes[3].value);

      // Get the query string of id in the link to identify each items
      const urlSearchParams = new URLSearchParams(window.location.search);
      const params = Object.fromEntries(urlSearchParams.entries());
      form.append("id", params.id);

      // Open http request
      request.open("POST", "././Controllers/Inventory.controller.php?action=edit");

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

      // Send the request with form
      request.send(form);
   })
}


/* 
   * Edit Images
*/

function editImg() {
   var inputImgs = document.getElementsByClassName("img");
   var rowImgs = document.getElementById("imgs-row");
   var srcOfNewImg;
   // Postion Is Mean The Position Of The Image That User Want To Change It
   var position;
   
   for(let i = 0; i < inputImgs.length; i++) {
      inputImgs[i].addEventListener("input", () => {
         position = i;

         srcOfNewImg = inputImgs[i].files[0];

         let request = new XMLHttpRequest();
         let form = new FormData();

         form.append("img", srcOfNewImg);
         form.append("posImg", position);

         // Get the query string of id in the link to identify each items
         const urlSearchParams = new URLSearchParams(window.location.search);
         const params = Object.fromEntries(urlSearchParams.entries());
         form.append("id", params.id);

         // Open http request
         request.open("POST", "././Controllers/Inventory.controller.php?action=edit-img");

         request.onreadystatechange = () => {
            if (request.readyState === 4 && request.status === 200) {
               rowImgs.innerHTML = request.responseText;
            }
         }

         // Send the request with form
         request.send(form);
      })
   }
}

/*
   * Add new items Function
*/

var inputImg = document.getElementById("new-img");
var rowImg = document.getElementById("img-row");
var reset = document.getElementById("rstBtn");
var imagesArray = Array();

// ! I Checked If There Is Search Input Because This File Is Used In More Than Page //
if(inputImg !== null) {
   inputImg.addEventListener("input", () => {
      // add Every input in the array
      imagesArray.push(inputImg.files[0]);
      // Show The Img Selected To User
      var imgElm = document.createElement("img");
      // Create A Temporary Url To Show The Image
      var src = URL.createObjectURL(inputImg.files[0]);
      imgElm.setAttribute("src", src);
      imgElm.setAttribute("class", "img-ls");
      rowImg.appendChild(imgElm);
   });

   reset.addEventListener("click", () => {
      emtyInputImg();
   })

   // Empty the input field of image and the array when reset the choices
   var emtyInputImg = () => {
      imagesArray = Array();

      rowImg.innerHTML = "";

      inputImg.value = "";
   }

   var saveBtn = document.getElementById("submit-new");
   var inputs = document.getElementsByClassName("add-input");
   var categoryBtn5 = document.getElementById("catBtn");

   saveBtn.addEventListener("click", () => {

      let request = new XMLHttpRequest();
      let form = new FormData();

      for(let i = 0; i < inputs.length; i++) {
         form.append(inputs[i].name, inputs[i].value);   
      }

      form.append("cat", categoryBtn5.attributes[3].value);

      // Set every image has been selected into input to send it 
      imagesArray.forEach(function(image, i) {
         form.append('imgsDetails_' + i, image);
      });

      // Open http request
      request.open("POST", "././Controllers/Inventory.controller.php?action=add-item");

      request.onreadystatechange = () => {
         if (request.readyState === 4 && request.status === 200) {
            // If success
            if(request.responseText == "") {
               saySuccess("Data Saved");
               // Empty every input field
               for(let i = 0; i < inputs.length; i++) {
                  inputs[i].value = "";  
                  window.scrollTo(0, 0); 
                  emtyInputImg();
                  categoryBtn5.innerHTML = "Select Category";
               }
            } else {
               // If there is error
               sayError(request.responseText);
               window.scrollTo(0, 0);
            }
         }
      }

      // Send the request with form
      request.send(form);
   })
}
