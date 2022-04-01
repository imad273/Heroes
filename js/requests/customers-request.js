/*
   * Search Function 
*/

var searchField = document.getElementById("search-ipt");

// ! I Checked If There Is Search Input Because This File Is Used In More Than Page //
if (searchField != null) {
   searchField.addEventListener("input", () => {
      
      let request = new XMLHttpRequest();
      let form = new FormData();

      form.append("keyword", searchField.value);

      // Open http request
      request.open("POST", "././Controllers/Customers.controller.php?action=search");

      request.onreadystatechange = () => {
         if (request.readyState === 4 && request.status === 200) {
            // Output The Response In The Table
            tbody.innerHTML = request.responseText;
         }
      }

      // Send the request with form
      request.send(form);
   })
}

/*
   * Delete Function 
*/

function deleteUser(id) {
   var alertMsg = document.getElementById("conf-alert");
   var cancel = document.getElementById("cancelBtn");
   var yesBtn = document.getElementById("yesBtn");
   
   var userId = id;
   alertMsg.style.display = "flex";

   // If The User Click On Yes Button Send The Request
   yesBtn.addEventListener("click", () => {
      let request = new XMLHttpRequest();
      let form = new FormData();

      form.append("userId", userId);

      // Open http request
      request.open("POST", "././Controllers/Customers.controller.php?action=delete");

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