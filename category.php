<?php
   session_start();
   // Title
   $title = "Inventory";
   
   require "functions.php";
   include "includes/head.php";
   
   if (isset($_SESSION["admin_login"])) { 
      $link = isset($_GET['action']) ? $_GET['action'] : "manage";
      if($link == "manage") { ?>
         <section class="category d-flex">
            <?php include "includes/navbar.php"; ?>
         <div class="content">
            <div class="header">
               <div class="tit">
                  <i class='bx bxs-cube'></i>
                  <span> Categories</span>
               </div>
               <div class="open-menu">
                  <i id='menu-btn' class='bx bx-menu-alt-right'></i>
               </div>
            </div>
            <div class="note d-flex align-items-center">
               <div class="icn">
                  <i class='bx bxs-info-circle'></i>
               </div>
               <div class="con">
                  <span>notice*: </span><p>When you delete Category, All the items in this Categoty will be deleted!</p>
               </div>
            </div>
            <div class="inv-table m-2">
               <div class="table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                           <th class="text-center">#</th>
                           <th>Category Name</th>
                           <th>Items In This Category</th>
                           <th class="text-center">Actions</th>
                        </tr>
                     </thead>
                     <tbody id="tbody">
                        <?php
                           $cls = new DataBase();
                           $con = $cls->_connect();
                           $stmt = $con->prepare("SELECT * FROM categories");
                           $stmt->execute();

                           if($stmt->rowCount() == 0) {
                              echo "<th colspan='5' class='text-center align-middle'><i class='bx bxs-info-circle bx-tada' style='color: #47E6F6; font-size: 32px'></i><p>No Items To Show</p></th>";
                           } else {
                              while($ftc = $stmt->fetch()) {
                                 $id = $ftc['Cat_id'];
                                 $stmt2 = $con->prepare("SELECT COUNT(Item_ID) FROM items WHERE Category = '$id'");
                                 $stmt2->execute();
                                 $ftc2 = $stmt2->fetchColumn();

                                 echo "<tr>
                                    <th class='id text-center'>" . $id  . "</th>
                                    <td>" . $ftc['Name'] . "</td>
                                    <td>" . $ftc2 . "</td>
                                    <td class='text-center'>
                                       <a onclick='deleteCategory(" . $id . ")' class='icn-dlt'><i class='bx bxs-trash'></i></a>
                                    </td>
                                 </tr>";
                              }  
                           } ?>
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
      </section>
<?php 
      } elseif ($link == "add-category") { ?>
         <section class="category d-flex">
            <?php include "includes/navbar.php"; ?>
            <div class="content">
               <div class="header">
                  <div class="tit">
                     <i class='bx bxs-cube'></i>
                     <span> Add New Category</span>
                  </div>
                  <div class="open-menu">
                     <i id='menu-btn' class='bx bx-menu-alt-right'></i>
                  </div>
               </div>
               <div class="cat-form">
                  <div class="alert-err" id="alert">
                     <div id="err-msg"></div>
                  </div>
                  <form onsubmit="return false">
                     <div class="mb-3">
                        <label for="add-input" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="add-input" autocomplete="OFF">
                     </div>
                     <div class="submit d-flex">
                        <button class="btn btn-primary ms-auto" id="submit-new">Save</button>
                     </div>
                  </form>
               </div>
            </div>
         </section>
<?php
      }
   }
?>

   <!-- Inventory requests -->
   <script src="js/requests/category-request.js"></script>

<?php
   include "includes/footer.php";
?>