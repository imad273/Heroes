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


var saveBtn = document.getElementById("submit-new");
var inputs = document.getElementsByClassName("edit-input");

if(saveBtn !== null) {
   saveBtn.addEventListener("click", () => {
      let request = new XMLHttpRequest();
      let form = new FormData();

      for(var i = 0; i < inputs.length; i++) {
         form.append(inputs[i].name, inputs[i].value);
      }

      request.open("POST", "././Controllers/Settings.controller.php?action=edit-admin");

      request.onreadystatechange = function() {
         if(request.readyState === 4 && request.status === 200) {
            if(request.responseText == 'succ') {
               saySuccess("Data Saved");
            } else {
               sayError(request.responseText);
            }
         }
      } 

      request.send(form);
   })
}


var saveBtn2 = document.getElementById("submit-new-pass");
var pasInputs = document.getElementsByClassName("pass-input");

if(saveBtn2 !== null) {
   saveBtn2.addEventListener("click", () => {

      let request = new XMLHttpRequest();
      let form = new FormData();

      for(var i = 0; i < pasInputs.length; i++) {
         form.append(pasInputs[i].name, pasInputs[i].value);
      }

      request.open("POST", "././Controllers/Settings.controller.php?action=edit-pass");

      request.onreadystatechange = function() {
         if(request.readyState === 4 && request.status === 200) {
            if(request.responseText == 'succ') {
               saySuccess("Data Saved");
            } else {
               sayError(request.responseText);
            }
         }
      } 

      request.send(form);
   })
}