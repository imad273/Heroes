<?php
   session_start();
   // Title
   $title = "Settings";

   require "functions.php";
   include "includes/head.php";

   if (isset($_SESSION["admin_login"])) { ?>
      <section class="stg d-flex">
         <?php include "includes/navbar.php"; ?>
         <div class="content">
            <div class="header">
               <div class="tit">
                  <i class='bx bxs-cube'></i>
                  <span> Settings</span>
               </div>
            </div>
         </div>
      </section>
<?php
   }

   include "includes/footer.php";
?>