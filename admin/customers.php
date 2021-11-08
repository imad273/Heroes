<?php
   session_start();
   // Title
   $title = "Customers";

   
   require "functions.php";
   include "includes/head.php";

   if (isset($_SESSION["admin_login"])) { ?>
      <section class="cust d-flex">
         <?php include "includes/navbar.php"; ?>
         <div class="content">
            <div class="header">
               <div class="tit">
                  <i class='bx bxs-cube'></i>
                  <span> Customers</span>
               </div>
            </div>
            <div class="cus-table m-2">
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
                           <th>Name</th>
                           <th>Username</th>
                           <th>Email</th>
                           <th>Country</th>
                           <th>Date Regester</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="tbody">
                        <?php   
                           $stmt = getUsersData();
                           if($stmt->rowCount() == 0) {
                              echo "<th colspan='5' class='text-center align-middle'><i class='bx bxs-info-circle bx-tada' style='color: #47E6F6; font-size: 32px'></i><p>No Users To Show</p></th>";
                           } else {
                              while($ftc = $stmt->fetch()) {
                                 echo "<tr>
                                    <td>" . $ftc['Name'] . "</td>
                                    <td>" . $ftc['UserName'] . "</td>
                                    <td>" . $ftc['Email'] . "</td>
                                    <td>" . $ftc['Country'] . "</td>
                                    <td>" . formateDate($ftc['Date']) . "</td>
                                    <td class='text-center'>
                                       <a onclick='deleteUser(" . $ftc['User_id'] . ")' class='icn-dlt'><i class='bx bxs-trash'></i></a>
                                    </td>
                                 </tr>";
                              }
                           }
                        ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="conf-alert" id="conf-alert">
            <div class="confirm-msg">
               <span>Are You Sure You Want To Delete?</span>
               <div class="btns float-end">
                  <button class="btn btn-danger" id="cancelBtn">Cancel</button>
                  <button class="btn btn-success" id="yesBtn">Yes</button>
               </div>
               </div>
         </div>
      <section>


<?php
   } else {
      header("location: index.php");
   } ?>

   <!-- Inventory requests -->
   <script src="js/requests/customers-request.js"></script> 

<?php
   include "includes/footer.php";
?>