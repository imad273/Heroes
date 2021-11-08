<?php
   session_start();
   // Title
   $title = "Messages";

   require "functions.php";
   include "includes/head.php";

   if (isset($_SESSION["admin_login"])) { ?>
      <section class="msgs d-flex">
         <?php include "includes/navbar.php"; ?>
         <div class="content">
            <div class="header">
               <div class="tit">
                  <i class='bx bxs-cube'></i>
                  <span> Messages</span>
               </div>
            </div>
            <div class="msgs-con">
               <div class="msg">
                  <div class="msg-info d-flex align-items-center">
                     <div class="img">
                        <img src="images/male.jpg" alt="profile-img">
                     </div>
                     <div class="usr-det">
                        <h5>Liam Kittilsen</h5>
                        <p>Lorem ipsum dolor sit amet consectetu ssimus culpa laborum voluptates, sit maxime tempora pariatur? Placeat sunt nulla, suscipit assumenda repellat inventore repellendus! Porro in sed repellendus vel quis facere nobis?</p>
                        <span>5 min ago</span>
                     </div>
                  </div>
               </div>
                  <hr class="dropdown-divider">
               <div class="msg">
                  <div class="msg-info d-flex align-items-center">
                     <div class="img">
                        <img src="images/female.jpg" alt="profile-img">
                     </div>
                     <div class="usr-det">
                        <h5>Roqaya Sabih Nassar</h5>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat labore porro modi similique. Quo, facere autem? Similique sunt nam sed fuga, assumenda ipsa at temporibus cupiditate voluptas reiciendis quibusdam suscipit.</p>
                        <span>1h ago</span>
                     </div>
                  </div>
               </div>
                  <hr class="dropdown-divider">
               <div class="msg">
                  <div class="msg-info d-flex align-items-center">
                     <div class="img">
                        <img src="images/female.jpg" alt="profile-img">
                     </div>
                     <div class="usr-det">
                        <h5>Christopher A. Lang</h5>
                        <p>Lorem ipsum dolor, sit amet repellat consectetur adipisicing elit. Animi aperiam repellat itaque!</p>
                        <span>1:23pm</span>
                     </div>
                  </div>
               </div>
                  <hr class="dropdown-divider">
            </div>
         </div>
      </section>
<?php
   }

   include "includes/footer.php";
?>