<?php

session_start();

$title = "Dashboard";

include "functions.php";
include "includes/head.php";

if (isset($_SESSION["admin_login"])) { ?>
   <section class="dashboard d-flex">
      <?php include "includes/navbar.php"; ?>
      <div class="content">
         <div class="header d-flex justify-content-between align-items-center">
            <div class="tit d-flex justify-content-center flex-column">
               <span> Dashboard</span>
               <p>Welcome to Dashboard</p>
            </div>
            <div>
               <img src="./images/profile.png" alt="IMG">
            </div>
         </div>
         <div class="overview pt-2 d-flex justify-content-center flex-wrap">
            <div class="tab">
               <div class="info d-flex align-items-center">
                  <div class="icon">
                     <svg width="24" height="24" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.65653 7.7721C8.22925 8.78895 7.99312 9.90592 7.99312 11.078C7.99312 14.3549 9.83864 17.2007 12.547 18.6328C11.9454 18.8456 11.298 18.9614 10.6235 18.9614C7.4386 18.9614 4.85675 16.3796 4.85675 13.1947C4.85675 10.7005 6.44013 8.57623 8.65653 7.7721ZM25.0738 11.078C25.0738 14.3549 23.2283 17.2007 20.5199 18.6328C21.1215 18.8456 21.7689 18.9614 22.4434 18.9614C25.6283 18.9614 28.2102 16.3796 28.2102 13.1947C28.2102 10.7005 26.6268 8.57622 24.4104 7.77209C24.8376 8.78895 25.0738 9.90592 25.0738 11.078Z" fill="#1CD4D4" />
                        <path d="M16.5335 17.6476C20.1617 17.6476 23.103 14.7063 23.103 11.0781C23.103 7.44986 20.1617 4.50861 16.5335 4.50861C12.9052 4.50861 9.96399 7.44986 9.96399 11.0781C9.96399 14.7063 12.9052 17.6476 16.5335 17.6476Z" fill="#1CD4D4" />
                        <rect x="4.70837" y="20.2753" width="23.6501" height="7.88338" rx="3.94169" fill="#1CD4D4" />
                        <rect x="7.60962" y="20.2753" width="17.8477" height="7.88338" rx="3.94169" fill="white" />
                        <rect x="9.96399" y="20.2753" width="13.139" height="7.88338" rx="3.94169" fill="#1CD4D4" />
                     </svg>
                  </div>
                  <div class="ps-2">
                     <p><?php echo CountRows("User_id", "users") ?></p>
                     <span>User</span>
                  </div>
               </div>
            </div>
            <div class="tab">
               <div class="info d-flex align-items-center">
                  <div class="icon">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.79166 2H1V4H4.2184L6.9872 16.6776H7V17H20V16.7519L22.1932 7.09095L22.5308 6H6.6552L6.08485 3.38852L5.79166 2ZM19.9869 8H7.092L8.62081 15H18.3978L19.9869 8Z" fill="#1CD4D4" />
                        <path d="M10 22C11.1046 22 12 21.1046 12 20C12 18.8954 11.1046 18 10 18C8.89543 18 8 18.8954 8 20C8 21.1046 8.89543 22 10 22Z" fill="#1CD4D4" />
                        <path d="M19 20C19 21.1046 18.1046 22 17 22C15.8954 22 15 21.1046 15 20C15 18.8954 15.8954 18 17 18C18.1046 18 19 18.8954 19 20Z" fill="#1CD4D4" />
                     </svg>
                  </div>
                  <div class="ps-2">
                     <p><?php echo CountRows("Pur_id", "purchase") ?></p>
                     <span>Total Sales</span>
                  </div>
               </div>
            </div>
            <div class="tab">
               <div class="info d-flex align-items-center">
                  <div class="icon">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 8V16C2 16.5523 2.44772 17 3 17H16.6202C16.9121 17 17.1895 16.8724 17.3795 16.6508L20.808 12.6508C21.129 12.2763 21.129 11.7237 20.808 11.3492L17.3795 7.34921C17.1895 7.12756 16.9121 7 16.6202 7H3C2.44772 7 2 7.44772 2 8ZM0 8V16C0 17.6569 1.34315 19 3 19H16.6202C17.496 19 18.328 18.6173 18.898 17.9524L22.3265 13.9524C23.2895 12.8289 23.2895 11.1711 22.3265 10.0476L18.898 6.04763C18.328 5.38269 17.496 5 16.6202 5H3C1.34315 5 0 6.34315 0 8Z" fill="#1CD4D4" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15 13C15.5523 13 16 12.5523 16 12C16 11.4477 15.5523 11 15 11C14.4477 11 14 11.4477 14 12C14 12.5523 14.4477 13 15 13ZM15 15C16.6569 15 18 13.6569 18 12C18 10.3431 16.6569 9 15 9C13.3431 9 12 10.3431 12 12C12 13.6569 13.3431 15 15 15Z" fill="#1CD4D4" />
                     </svg>
                  </div>
                  <div class="ps-2">
                     <p><?php echo CountRows("Item_ID", "items") ?></p>
                     <span>Products</span>
                  </div>
               </div>
            </div>
            <div class="tab">
               <div class="info d-flex align-items-center">
                  <div class="icon">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 10H17V16H13V10Z" fill="#1CD4D4" fill-opacity="0.5" />
                        <path d="M11 4H7V16H11V4Z" fill="#1CD4D4" />
                        <path d="M18 18H6V20H18V18Z" fill="#1CD4D4" />
                     </svg>
                  </div>
                  <div class="ps-2">
                     <p>$<?php echo SumRows("Cost", "purchase") ?></p>
                     <span>Cost</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="sec-2 d-flex">
            <div class="col-1">
               <div class="chart">
                  <canvas id="myChart"></canvas>
               </div>
            </div>
            <div class="col-2">
               <div class="user-li">
                  <h4>Recent users</h4>
                  <div class="d-flex flex-column">
                     <div class="d-flex align-items-center my-2">
                        <img src="./images/profile.png">
                        <h6 class="mb-0 ms-3">Leslie Alexander</h6>
                     </div>
                  </div>
                  <div class="d-flex flex-column">
                     <div class="d-flex align-items-center my-2">
                        <img src="./images/profile.png">
                        <h6 class="mb-0 ms-3">Leslie Alexander</h6>
                     </div>
                  </div>
                  <div class="d-flex flex-column">
                     <div class="d-flex align-items-center my-2">
                        <img src="./images/profile.png">
                        <h6 class="mb-0 ms-3">Wade Warren</h6>
                     </div>
                  </div>
                  <div class="d-flex flex-column">
                     <div class="d-flex align-items-center my-2">
                        <img src="./images/profile.png">
                        <h6 class="mb-0 ms-3">Leslie Alexander</h6>
                     </div>
                  </div>
               </div>
            </div>
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