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
                        <?php
                           $cls = new DataBase();
                           $con = $cls->_connect();
                           $stmt = $con->prepare("SELECT * FROM purchase ORDER BY pur_id DESC");
                           $stmt->execute();

                           if($stmt->rowCount() == 0) {
                              echo "<th colspan='5' class='text-center align-middle'><i class='bx bxs-info-circle bx-tada' style='color: #47E6F6; font-size: 32px'></i><p>No Items To Show</p></th>";
                           } else {
                              while($ftc = $stmt->fetch()) {
                                 echo "<tr>
                                          <td>". $ftc['Customer_name'] ."</td>
                                          <td>". $ftc['Locality'] ."</td>
                                          <td>". $ftc['Product_name'] ."</td>
                                          <td>". $ftc['Quantity'] ."</td>
                                          <td>". $ftc['Date'] ."</td>
                                          <td>$". $ftc['Cost'] ."</td>
                                       </tr>";
                              }
                           } ?>
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
