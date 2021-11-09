<?php

session_start();

$title = "Dashboard";

include "functions.php";
include "includes/head.php";

if(isset($_SESSION["admin_login"])) { ?>
   <section class="dashboard d-flex">
      <?php include "includes/navbar.php"; ?>
      <div class="content">
         <div class="header">
            <div class="tit">
               <i class='bx bxs-dashboard'></i>
               <span> Dashboard</span>
            </div>
            <div class="open-menu">
               <i id='menu-btn' class='bx bx-menu-alt-right'></i>
            </div>
         </div>
         <div class="overview pt-2 d-flex justify-content-center flex-wrap">
            <div class="tab">
               <div class="header-tab p-2 d-flex justify-content-between align-items-center">
                  <h4>Sales Overview</h4>
                  <i class='bx bx-dots-vertical-rounded'></i>
               </div>
               
               <div class="row-m d-flex">
                  <div class="itm">
                     <i class='bx bxs-purchase-tag'></i>
                     <div class="res">
                        <p>Total Sales</p>
                        <span><?php echo CountRows("Pur_id", "purchase") ?></span>
                     </div>
                  </div>
                  <div class="itm">
                     <i class='bx bxs-badge-dollar'></i>
                     <div class="res">
                        <p>Total Product</p>
                        <span><?php echo CountRows("Item_ID", "items") ?></span>
                     </div>
                  </div>
               </div>
               <div class="row-m d-flex">
                  <div class="itm">
                     <i class='bx bxs-bar-chart-alt-2' ></i>
                     <div class="res">
                        <p>Revenue</p>
                        <span>17565</span>
                     </div>
                  </div>
                  <div class="itm">
                     <i class='bx bxs-wallet-alt'></i>
                     <div class="res">
                        <p>Profit</p>
                        <span>5077</span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab">
               <div class="header-tab p-2 d-flex justify-content-between align-items-center">
                  <h4>Customers Overview</h4>
                  <i class='bx bx-dots-vertical-rounded'></i>
               </div>
               <div class="row-m d-flex">
                  <div class="itm">
                     <i class='bx bxs-user-detail'></i> 
                     <div class="res">
                        <p>Total Users</p>
                        <span><?php echo CountRows("User_id", "users") ?></span>
                     </div>
                  </div>
                  <div class="itm">
                     <i class='bx bxs-badge-dollar'></i>
                     <div class="res">
                        <p>Cost</p>
                        <span>$<?php echo SumRows("Cost", "purchase") ?></span>
                     </div>
                  </div>
               </div>
               <div class="row-m d-flex">
                  <div class="itm">
                     <i class='bx bxs-star'></i>
                     <div class="res">
                        <p>Reviews</p>
                        <span>17565</span>
                     </div>
                  </div>
                  <div class="itm">
                     <i class='bx bxs-envelope'></i>
                     <div class="res">
                        <p>Messages</p>
                        <span><?php echo CountRows("Msg_id", "messages") ?></span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="chart">
            <canvas id="myChart"></canvas>
         </div>
      </div>
   </section>
   

<?php
} else {
   header("location: index.php");
}

include "includes/footer.php";
?>
<!-- Chart -->
<script src="js/chart.js"></script>