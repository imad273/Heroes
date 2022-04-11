<?php
   session_start();
   // Title
   $title = "Settings";

   require "functions.php";
   include "includes/head.php";

   if (isset($_SESSION["admin_login"])) { 
      $link = isset($_GET['action']) ? $_GET['action'] : "manage";
      if($link == "manage") { ?>
         <section class="stg d-flex">
            <?php include "includes/navbar.php"; ?>
            <div class="content">
               <div class="header d-flex justify-content-between align-items-center">
                  <div class="tit d-flex justify-content-center flex-column">
                     <span>Settings</span>
                  </div>
                  <div>
                     <img src="./images/profile.png" alt="IMG">
                  </div>
               </div>
               <div class="set-con"> 
                  <?php
                     $id = $_SESSION['admin_login'];
                     $cls = new DataBase();
                     $con = $cls->_connect();
                     $stmt = $con->prepare("SELECT * FROM users WHERE User_id = '$id'");
                     $stmt->execute(); 
                     $ftc = $stmt->fetch(); 
                  ?>
                  <h3>Profile Settings</h3>
                  <div class="alert-err" id="alert">
                     <div id="err-msg"></div>
                  </div>
                  <form onsubmit="return false">
                     <div class="mb-3">
                        <label for="username" class="form-label">Userame</label>
                        <input type="text" name="username" value="<?php echo $ftc['UserName'] ?>" class="form-control edit-input" id="username" autocomplete="OFF">
                     </div>
                     <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" value="<?php echo $ftc['Email'] ?>" class="form-control edit-input" id="email" autocomplete="OFF">
                     </div>
                     <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="<?php echo $ftc['Name'] ?>" class="form-control edit-input" id="email" autocomplete="OFF">
                     </div>
                     <div class="submit d-flex">
                        <button class="btn btn-primary w-25 m-auto mb-2" id="submit-new">Save</button>
                     </div>
                     <div class="mb-3">
                        <div class="ctbtn d-flex">
                           <a href="?action=edit-pass" class="btn btn-primary w-25 m-auto">Edit Password</a>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </section>
<?php
      } elseif ($link == "edit-pass") { ?>
         <section class="stg d-flex">
            <?php include "includes/navbar.php"; ?>
            <div class="content">
               <div class="header d-flex justify-content-between align-items-center">
                  <div class="tit d-flex justify-content-center flex-column">
                     <span>Edit Password</span>
                  </div>
                  <div>
                     <img src="./images/profile.png" alt="IMG">
                  </div>
               </div>
               <div class="set-con">
                  <div class="alert-err" id="alert">
                     <div id="err-msg"></div>
                  </div>
                  <form onsubmit="return false">
                     <div class="mb-3">
                        <label for="pass" class="form-label">Current Password</label>
                        <input type="text" name="pass" class="form-control pass-input" id="pass" autocomplete="OFF">
                     </div>
                     <div class="mb-3">
                        <label for="new-pass" class="form-label">New Password</label>
                        <input type="text" name="new-pass" class="form-control pass-input" id="new-pass" autocomplete="OFF">
                     </div>
                     <div class="mb-3">
                        <label for="con-pass" class="form-label">Confirm Password</label>
                        <input type="text" name="con-pass" class="form-control pass-input" id="con-pass" autocomplete="OFF">
                     </div>
                     <div class="submit d-flex">
                        <button class="btn btn-primary ms-auto" id="submit-new-pass">Save</button>
                     </div>
                  </form>
               </div>
            </div>
         </section>
<?php
      }
   }
?>

   <!-- Inventory requests -->
   <script src="js/requests/settings-request.js"></script>

<?php
   include "includes/footer.php";
?>