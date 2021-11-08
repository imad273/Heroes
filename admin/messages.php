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
                                    <span>"; 
                                       $date1 = new DateTime($ftc['Date']);
                                       $date2 = new DateTime(date("Y-m-d H:i:s"));
                                    
                                       $interval = $date1->diff($date2);
                                    
                                       if($interval->h == 0) {
                                          echo $interval->i . "m ago";
                                       } elseif($interval->d >= 2) {
                                          echo formateDate($ftc['Date'], true);
                                       } elseif($interval->d >= 1) {
                                          echo "yesterday";
                                       } elseif($interval->h >= 1) {
                                          echo $interval->h . "h ago";
                                       } 

                                    echo "</span>
                                 </div>
                              </div>
                           </div>
                           <hr class='dropdown-divider'>";
                  }
               ?>
            </div>
         </div>
      </section>
<?php
   }

   include "includes/footer.php";
?>