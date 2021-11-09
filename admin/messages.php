<?php
   session_start();
   // Title
   $title = "Messages";

   require "functions.php";
   include "includes/head.php";

   if (isset($_SESSION["admin_login"])) { 
      $link = isset($_GET['action']) ? $_GET['action'] : "manage";
      if($link == "manage") { ?>
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
                                       <a href='?action=show-message&id=" . $ftc['Msg_id'] . "'><h4>" . $ftc['Name'] . "</h4></a>
                                       <label>From: " . $ftc['Email'] . "</label>
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
      } elseif ($link == "show-message") { 
         $id = $_GET['id']; 
         $cls = new DataBase();
         $con = $cls->_connect();
         $stmt = $con->prepare("SELECT * FROM messages WHERE Msg_id='$id'");
         $stmt->execute(); 
         $ftc = $stmt->fetch() ?>
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
                  <div class="show-mgs">
                     <h4><?php echo $ftc['Name'] ?></h4>
                     <label>From: <?php echo $ftc['Email'] ?></label>
                     <span>
                     <?php   
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
                        } ?>
                     </span>
                     <p><?php echo $ftc['Message'] ?></p>
                  </div>
               </div>
            </div>
         </section>

<?php
      }
   }

   include "includes/footer.php";
?>