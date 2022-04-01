<?php 
   session_start();
   // Title
   $title = "Login";

   include "functions.php";
   include "includes/head.php";

   if(isset($_SESSION["admin_login"])) {
      header("location: dashboard.php");
   }
?>
   <section class="login d-flex justify-content-center align-items-center">
      <div class="content-login d-flex justify-content-center align-items-center flex-column">
         <div class="logo">
            <img src="images/logo.png" alt="LOGO">
         </div>
         <div class="form w-100 p-3">
         <div class="alert-me" id="alert">
            <div id="err-msg"></div>
         </div>
            <form onsubmit="return false">
               <div class="mb-3">
                  <label for="username" class="form-label">Email address</label>
                  <input type="text" name="username" value="admin" class="form-control" id="username" autocomplete="OFF">
               </div>
               <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" value="admin" class="form-control" id="password">
               </div>
               <button class="btn btn-primary w-100" id="submit">Login</button>
            </form>
         </div>
      </div>
   </section>

   <!-- Inventory requests -->
   <script src="js/requests/login-request.js"></script>
<?php
   include "includes/footer.php";
?>