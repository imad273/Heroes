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
   * Delete Function
*/

function deleteCategory(id) {
   var alertMsg = document.getElementById("conf-alert");
   var cancel = document.getElementById("cancelBtn");
   var yesBtn = document.getElementById("yesBtn");
   
   var catId = id;
   alertMsg.style.display = "flex";

   // If The User Click On Yes Button Send The Request
   yesBtn.addEventListener("click", () => {
      let request = new XMLHttpRequest();
      let form = new FormData();

      form.append("catId", catId);

      // Open http request
      request.open("POST", "././Controllers/Category.controller.php?action=delete");

      request.onreadystatechange = () => {
         if (request.readyState === 4 && request.status === 200) {
            alertMsg.style.display = "none";

            // Print The Remaining Items
            tbody.innerHTML = request.responseText;
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
   * Add New Category
*/

var saveBtn = document.getElementById("submit-new");
var input = document.getElementById("add-input");

if(saveBtn !== null) {
   saveBtn.addEventListener("click", () => {

      let request = new XMLHttpRequest();
      let form = new FormData();

      form.append("catName", input.value);
      
      // Open http request
      request.open("POST", "././Controllers/Category.controller.php?action=add-category");

      request.onreadystatechange = () => {
         if (request.readyState === 4 && request.status === 200) {
            // If success
            if(request.responseText == "") {
               saySuccess("Data Saved");
               // Empty every input field
               input.value = "";
               
            } else {
               // If there is error
               sayError(request.responseText);
            }
         }
      }

      // Send the request with form
      request.send(form);
   })
}