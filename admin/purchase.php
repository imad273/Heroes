<?php
   session_start();
   // Title
   $title = "Purchase";

   
   require "functions.php";
   include "includes/head.php";

   if (isset($_SESSION["admin_login"])) { ?>
      <section class="purchase d-flex">
         <?php include "includes/navbar.php"; ?>
         <div class="content">
            <div class="header">
               <div class="tit">
                  <i class='bx bxs-cube'></i>
                  <span> Purchase</span>
               </div>
            </div>
            <div class="pur-table m-2">
               <div class="control p-2 d-flex flex-row-reverse">
                  <div class="search m-2">
                     <div class="input-group">
                        <label for="search-ipt" class="input-group-text" id="basic-addon2"><i class='bx bx-search-alt'></i></label>
                        <input type="text" id="search-ipt" class="form-control" placeholder="Search">
                     </div>
                  </div>
               </div>
               <div class="table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>Customer</th>
                           <th>Locality</th>
                           <th>Order</th>
                           <th>Quantity</th>
                           <th>Created</th>
                           <th>Cost</th>
                        </tr>
                     </thead>
                     <tbody id="tbody">
                        <tr>
                           <td>Laurin Michel</td>
                           <td>Nedrow, NY, United States</td>
                           <td>MuscleTech Nitro-Tech</td>
                           <td>2</td>
                           <td>04 OCT 2021 13:44</td>
                           <td>$120,00</td>
                        </tr>
                        <tr>
                           <td>Adam dgorge</td>
                           <td>Guandi, China</td>
                           <td>Life Fitness Studio Deck</td>
                           <td>1</td>
                           <td>02 OCT 2021 16:26</td>
                           <td>$240,00</td>
                        </tr>
                        <tr>
                           <td>Laurin Michel</td>
                           <td>Nedrow, NY, United States</td>
                           <td>Hammer Strength Round Urethane Dumbbells 35g</td>
                           <td>2</td>
                           <td>04 OCT 2021 13:44</td>
                           <td>$70,00</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      <section>
<?php
   }
   include "includes/footer.php";
?>


?>