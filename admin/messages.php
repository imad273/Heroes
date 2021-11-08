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
               <?php
                  $stmt = getMessages();
                  while($ftc = $stmt->fetch()) {
                     echo "<div class='msg'>
                              <div class='msg-info'>
                                 <div class='usr-det'>
                                    <h5>" . $ftc['Name'] . "</h5>
                                    <p>" . $ftc['Message'] . "</p>
                                    <span>" . formateDate($ftc['Date'], true) . "</span>
                                 </div>
                              </div>
                           </div>
                           <hr class='dropdown-divider'>";
                  }
               ?>
               <!-- <div class="msg">
                  <div class="msg-info d-flex align-items-center">
                     
                     <div class="usr-det">
                        <h5>Liam Kittilsen</h5>
                        <p>Lorem ipsum dolor sit amet consectetu ssimus culpa laborum voluptates, sit maxime tempora pariatur? Placeat sunt nulla, suscipit assumenda repellat inventore repellendus! Porro in sed repellendus vel quis facere nobis?</p>
                        <span>5 min ago</span>
                     </div>
                  </div>
               </div> -->
                  <!-- <hr class="dropdown-divider"> -->
               
            </div>
         </div>
      </section>
<?php
   }

   include "includes/footer.php";
?>