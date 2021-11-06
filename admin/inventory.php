<?php
   session_start();
   // Title
   $title = "Inventory";

   
   require "functions.php";
   include "includes/head.php";
   
   if (isset($_SESSION["admin_login"])) { 
      $link = isset($_GET['action']) ? $_GET['action'] : "manage";
      if($link == "manage") { ?>
         <section class="inventory d-flex">
            <?php include "includes/navbar.php"; ?>
            <div class="content">
               <div class="header">
                  <div class="tit">
                     <i class='bx bxs-cube'></i>
                     <span> Inventory</span>
                  </div>
               </div>
               <div class="inv-table m-2">
                  <div class="control p-2 d-flex justify-content-between align-center flex-wrap">
                     <div class="dropdown m-2">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuBtn" data-bs-toggle="dropdown" aria-expanded="false">
                           Select Category
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuBtn">
                           <li data="0" class="dropdown-item cats">All</li>
                        <?php
                           $stmt = getData("categories");
                           while($ftc = $stmt->fetch()) {
                              echo "<li data='" . $ftc["cat_ID"] . "' class='dropdown-item cats'>" . $ftc["Name"] . "</li>";
                           }   ?>
                        </ul>
                     </div>
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
                              <th class="text-center">#</th>
                              <th>Item Name</th>
                              <th>Item Category</th>
                              <th>Quantity</th>
                              <th class="text-center">Actions</th>
                           </tr>
                        </thead>
                        <tbody id="tbody">
                           <?php
                              $cls = new DataBase();
                              $con = $cls->_connect();
                              $stmt = $con->prepare("SELECT items.*, categories.Name AS Category_Name FROM items INNER JOIN categories ON items.Category = categories.cat_ID ORDER BY Item_ID DESC");
                              $stmt->execute();

                              if($stmt->rowCount() == 0) {
                                 echo "<th colspan='5' class='text-center align-middle'><i class='bx bxs-info-circle bx-tada' style='color: #47E6F6; font-size: 32px'></i><p>No Items To Show</p></th>";
                              } else {
                                 while($ftc = $stmt->fetch()) {
                                    echo "<tr>
                                       <th class='id text-center'>" . $ftc['Item_ID']  . "</th>
                                       <td>" . $ftc['Name'] . "</td>
                                       <td>" . $ftc['Category_Name'] . "</td>
                                       <td>" . $ftc['Quantity'] . "</td>
                                       <td class='text-center'>
                                          <a href='?action=edit&id=" . $ftc['Item_ID'] .  "' class='icn-edit'><i class='bx bxs-edit-alt'></i></a>
                                          <a onclick='deleteItem(" . $ftc['Item_ID'] . ")' class='icn-dlt'><i class='bx bxs-trash'></i></a>
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
      } elseif ($link == "edit") { ?>

         <section class="inventory d-flex">
            <?php include "includes/navbar.php"; ?>
            <div class="content">
               <div class="header">
                  <div class="tit">
                     <i class='bx bxs-cube'></i>
                     <span> Edit Item</span>
                  </div>
               </div>
               <div class="inv-form">
                  <div class="alert-err" id="alert">
                     <div id="err-msg"></div>
                  </div>
               <?php
                  $id = $_GET['id'];
                  $cls = new DataBase();
                  $con = $cls->_connect();
                  $stmt = $con->prepare("SELECT items.*, categories.Name AS Category_Name FROM items INNER JOIN categories ON items.Category = categories.cat_ID WHERE Item_ID = '$id'");
                  $stmt->execute();
                  $ftc = $stmt->fetch(); ?>

                  <form onsubmit="return false">
                     <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="<?php echo $ftc['Name'] ?>" class="form-control" id="name" autocomplete="OFF">
                     </div>
                     <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea name="desc" rows="5" class="form-control" id="desc"><?php echo $ftc['Description'] ?></textarea>
                     </div>
                     <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" value="<?php echo $ftc['Price'] ?>" class="form-control" id="price" autocomplete="OFF">
                     </div>
                     <div class="mb-3">
                        <label for="qua" class="form-label">Quantity</label>
                        <input type="text" name="qua" value="<?php echo $ftc['Quantity'] ?>" class="form-control" id="qua" autocomplete="OFF">
                     </div>
                     <div class="mb-3">
                        <label class="form-label">Category</label>
                        <div class="dropdown ">
                           <button class="btn btn-primary dropdown-toggle w-100 text-start" type="button" id="catBtn" data="<?php echo $ftc['Category'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
                              <?php echo $ftc['Category_Name'] ?>
                           </button>
                           <ul class="dropdown-menu w-100" aria-labelledby="catBtn">
                           <?php
                              $stmtCat = getData("categories");
                              while($ftcCat = $stmtCat->fetch()) {
                                 echo "<li data='" . $ftcCat["cat_ID"] . "' class='dropdown-item cats-edit'>" . $ftcCat["Name"] . "</li>";
                              }  ?>
                           </ul>
                        </div>
                     </div>
                     <div class="mb-3">
                        <div class="edit-img">
                           <label class="form-label d-block">Images</label>
                           <div class="row-me" id="imgs-row">
                              <?php
                              // I store the imges in the Database into Json Formate
                              // For that you will be convert it to PHP Array to use the images
                              $images = json_decode($ftc['Images']);
                              $index = 0;
                              foreach($images as $img) {
                                 $key = $index++;
                                 echo "<div class='blk'>
                                          <div class='cont' onmouseover='showControl(this)' onmouseout='hideControl(this)'>
                                             <div class='cntrl' id='cntrl'>
                                                <label for='img" . $key . "' class='edit-btns' onclick='editImg()'><i class='bx bxs-edit-alt'></i></label>
                                                <input type='file' name='img' accept='.png, .jpeg, .jpg' class='img' id='img" . $key . "'>
                                             </div>
                                             <img src='" . $img . "'>
                                          </div>
                                       </div>";
                              } ?>
                           </div>
                        </div>
                     </div>
                     <div class="submit d-flex">
                        <button class="btn btn-primary ms-auto" id="submit-edit">Save</button>
                     </div>
                  </form>
               </div>
            </div>
         </section>
<?php
      } elseif ($link == "add-items") { ?>
         <section class="inventory d-flex">
            <?php include "includes/navbar.php"; ?>
            <div class="content">
               <div class="header">
                  <div class="tit">
                     <i class='bx bxs-cube'></i>
                     <span> Add Item</span>
                  </div>
               </div>
               <div class="inv-form">
                  <div class="alert-err" id="alert">
                     <div id="err-msg"></div>
                  </div>
                  <form onsubmit="return false">
                     <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control add-input" id="name" autocomplete="OFF">
                     </div>
                     <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea name="desc" rows="5" class="form-control add-input" id="desc"></textarea>
                     </div>
                     <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" class="form-control add-input" id="price" autocomplete="OFF">
                     </div>
                     <div class="mb-3">
                        <label for="qua" class="form-label">Quantity</label>
                        <input type="text" name="qua" class="form-control add-input" id="qua" autocomplete="OFF">
                     </div>
                     <div class="mb-3">
                        <div class="dropdown ">
                           <button class="btn btn-primary dropdown-toggle w-100 text-start" type="button" id="catBtn" data="No Select" data-bs-toggle="dropdown" aria-expanded="false">
                              Select Category
                           </button>
                           <ul class="dropdown-menu w-100" aria-labelledby="catBtn">
                           <?php
                              $stmtCat = getData("categories");
                              while($ftcCat = $stmtCat->fetch()) {
                                 echo "<li data='" . $ftcCat["cat_ID"] . "' class='dropdown-item cats-edit'>" . $ftcCat["Name"] . "</li>";
                              }  ?>
                           </ul>
                        </div>
                     </div>
                     <div class="mb-3 add-images">
                        <input type="file" id="new-img" class="form-control" accept='.png, .jpeg, .jpg'>
                        <button class="btn btn-success float-end m-2" id="rstBtn"><i class='bx bx-refresh'></i> Reset</button>
                        <div class="row-me" id="img-row"></div>
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
   } else {
      header("location: index.php");
   } ?>

   <!-- Inventory requests -->
   <script src="js/requests/inventory-request.js"></script>

<?php
   include "includes/footer.php";
?>