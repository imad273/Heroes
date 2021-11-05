var submit = document.querySelector("#submit");
var fields = document.getElementsByClassName("form-control");
var usernameField = document.querySelector("#username");
var passwordField = document.querySelector("#password");
var alertMsg = document.querySelector("#alert");

submit.addEventListener("click", () => {
   if(passwordField.value == "" || usernameField.value == "") {
      sayError("Please Complete The Form");
   } else {
      let form = new FormData();
      
      let request = new XMLHttpRequest();


      for (let i = 0; i < fields.length; i++) {
         // Set each input value into the Form
         form.append(fields[i].name, fields[i].value);
      }

      request.open("POST", "././Controllers/LoginControl.php", true);
      submit.innerHTML = "<i class='bx bx-loader bx-spin' ></i>";
      request.onreadystatechange = () => {
         if(request.readyState === 4 && request.status === 200) {
            if(request.responseText == "seccess Login") {
               window.location = "./dashboard.php";
            } else {
               sayError(request.responseText);
            }
            submit.innerHTML = "Login";
         }
      }
      request.send(form);
   }
})

function sayError(msg) {
   if (msg != null) {
      alertMsg.style.display = "block";
      alertMsg.className = "alert-err";
      alertMsg.childNodes[1].innerHTML = "<i class='bx bxs-error'></i> " + msg;
      alertMsg.childNodes[1].setAttribute('id', "err-msg");
   } 
}