<?php

include "../functions.php";

$autoLoad = new inventory();

class inventory {

   public function __construct() {
      $action = isset($_GET["action"]) ? $_GET["action"] : header("location: ../index.php");;
      if($action == "category") {
         // Category Function
         $this->category();

      } elseif ($action == "search") {
         // Search Function
         $stmt = $this->search();

         // Output The New Data To users
         $this->table($stmt);

      } elseif ($action == "delete") {
         $itemId = $_POST['itemId'];

         // Delete Function
         $this->DeleteFromInve($itemId);

         // Get The New Data from Database
         $stmt = $this->getInventoryData();

         // Output The New Data To users
         $this->table($stmt);

      } elseif ($action == "edit") {
         $id = $_POST['id'];

         // Insert The new Data In Database
         $this->insertEdit($id);

      } elseif($action == "edit-img") {

         $id = $_POST['id'];

         // Insert The new Image In Database
         $this->editImg($id);

      } else {
         // If user come from external link
         header("location: ../index.php");
      } 
   }

   // This Function is to show The output (Result)
   private function table($stmt) {
         while($ftc = $stmt->fetch()) {
            echo "<tr>
               <th class='text-center'>" . $ftc['Item_ID']  . "</th>
               <td>" . $ftc['Name'] . "</td>
               <td>" . $ftc['Category_Name'] . "</td>
               <td>" . $ftc['Quantity'] . "</td>
               <td class='text-center'>
                  <a href='?action=edit&id=" . $ftc['Item_ID'] .  "' class='icn-edit'><i class='bx bxs-edit-alt'></i></a>
                  <a onclick='deleteItem(" . $ftc['Item_ID'] . ")' class='icn-dlt'><i class='bx bxs-trash'></i></a>
               </td>
            </tr>";
         }
   }

   // Connect To Databse Function
   private function conectDataBase(){
      $load = new DataBase();
      $con = $load->_connect();
      return $con;
   }

   /* 
      Function to get data from database
      * 1 = 1 is mean everything 
   */
   private function getInventoryData($where = "1 = 1") {
      $con = $this->conectDataBase();

      if($where !== "1 = 1") {
         $where = "WHERE items.Category = " . $where;
      } else {
         $where = "";
      }

      $stmt = $con->prepare("SELECT items.*, categories.Name AS Category_Name FROM items INNER JOIN categories ON items.Category = categories.cat_ID $where ORDER BY Item_ID DESC");
      $stmt->execute();
      
      if($stmt->rowCount() == 0) {
         echo "<th colspan='5' class='text-center align-middle'><i class='bx bxs-info-circle bx-tada' style='color: #47E6F6; font-size: 36px'></i><p>No Items To Show</p></th>";
      }

      return $stmt;
   }
   
   private function searchInventory($keyword) {
      $con = $this->conectDataBase();
   
      if($keyword !== "") {
         $keyword = "WHERE items.Name LIKE " . $keyword;
      } else {
         $keyword = "";
      }
   
      $stmt = $con->prepare("SELECT items.*, categories.Name AS Category_Name FROM items INNER JOIN categories ON items.Category = categories.cat_ID $keyword");
      $stmt->execute();

      if($stmt->rowCount() == 0) {
         echo "<th colspan='5' class='text-center align-middle'><i class='bx bxs-error-alt bx-flashing' style='color: #FF3A3A; font-size: 36px'></i><p>No Search Match</p></th>";
      }

      return $stmt;
   }

   private function category() {
      $category_id = $_POST["cat_id"];
      if($category_id == 0) {
         $stmt = $this->getInventoryData();
      } else {
         $stmt = $this->getInventoryData($category_id);
      }

      return $this->table($stmt);
   }

   private function search() {
      $keyValue = $_POST["keyword"];
      if($keyValue == "") {
         $stmt = $this->getInventoryData();
      } else {
         $keyword = "'%" . $keyValue . "%'";
         $stmt = $this->searchInventory($keyword);
      }

      return $stmt;
   }

   private function DeleteFromInve($id) {
      $con = $this->conectDataBase();
   
      $stmt = $con->prepare("DELETE FROM items WHERE Item_ID = '$id'");
      $stmt->execute();

      return $stmt;
   }

   private function insertEdit($id) {
      $con = $this->conectDataBase();
         
      $name = $_POST["name"];
      $desc = $_POST['desc'];
      $price = $_POST['price'];
      $que = $_POST['qua'];
      $cat = $_POST['cat'];

      $errors = array();

      if(empty($name)) {
         $errors[] = "Please Enter The Name";
      } elseif (empty($desc)) {
         $errors[] = "Please Enter Description";
      } elseif(empty($price)) {
         $errors[] = "Please Enter Price";
      } elseif(empty($que)) {
         $errors[] = "Please Enter Quantity";
      }

      foreach($errors as $error) {
         echo $error;
      }

      if(empty($errors)) {
         $stmt = $con->prepare("UPDATE items SET Name = ?, Description = ?, Price = ?, Quantity = ?, Category = ? WHERE Item_ID = '$id'");
         $stmt->execute(array($name, $desc, $price, $que, $cat));
         echo "succ";
      }
   }

   private function editImg($id) {
      $con = $this->conectDataBase();

      $stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = '$id'");
      $stmt->execute();
      $ftc = $stmt->fetch();
      
      $curent_imgs = $ftc['Images'];
      $arr_imgs = json_decode($curent_imgs);

      $img = $_FILES['img']['name'];
      $img_tmp = $_FILES['img']['tmp_name'];

      $image = rand(0, 100000000) . "_" . $img;
      move_uploaded_file($img_tmp, '..\uploads\\' . $image);

      $arr_imgs[$_POST['posImg']] = "uploads/" . $image;

      $imgs = json_encode($arr_imgs, JSON_UNESCAPED_SLASHES);

      $stmt = $con->prepare("UPDATE items SET Images = ?");
      $stmt->execute(array($imgs));


      $stmt2 = $con->prepare("SELECT * FROM items WHERE Item_ID = '$id'");
      $stmt2->execute();
      $ftc2 = $stmt2->fetch();


      $new_images = json_decode($ftc2['Images']);
      foreach($new_images as $img) {
         echo "<div class'col'>
                  <div class='cont' onmouseover='showControl(this)' onmouseout='hideControl(this)'>
                     <div class='cntrl' id='cntrl'>
                        <input type='file' name='img' id='img' class='edit-btn'>
                        <label for='img'><i class='bx bxs-edit-alt'></i></label>
                     </div>
                     <img src='" . $img . "'>
                  </div>
               </div>";
      }
   }

}
?>