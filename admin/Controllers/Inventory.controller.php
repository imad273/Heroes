<?php

include "../functions.php";

$autoLoad = new inventory();

class inventory {

   public function __construct() {
      $action = isset($_GET["action"]) ? $_GET["action"] : header("location: ../index.php");;
      if($action == "category") {
         // Category Function
         $stmt = $this->category();
         
         // Output The New Data To users
         $this->table($stmt);

      } elseif ($action == "search") {
         // Search Function
         $stmt = $this->search();

         // Output The New Data To users
         $this->table($stmt);

      } elseif ($action == "delete") {
         $itemId = $_POST['itemId'];

         // Delete Function
         $this->deleteFromInve($itemId);

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

      } elseif($action == "add-item") {

         $this->insertNewItem();


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
   
   // Get Data Search From Database Function
   private function getSearchData($keyword) {
      $con = $this->conectDataBase();
   
      if($keyword !== "") {
         $keyword = "WHERE items.Name LIKE " . $keyword;
      } else {
         $keyword = "";
      }
   
      $stmt = $con->prepare("SELECT items.*, categories.Name AS Category_Name FROM items INNER JOIN categories ON items.Category = categories.cat_ID $keyword");
      $stmt->execute();

      // If The Keyword Not Matched
      if($stmt->rowCount() == 0) {
         echo "<th colspan='5' class='text-center align-middle'><i class='bx bxs-error-alt bx-flashing' style='color: #FF3A3A; font-size: 36px'></i><p>No Search Match</p></th>";
      }

      return $stmt;
   }

   // Get items of the selected Category Data Function
   private function category() {
      $category_id = $_POST["cat_id"];
      if($category_id == 0) {
         $stmt = $this->getInventoryData();
      } else {
         $stmt = $this->getInventoryData($category_id);
      }

      return $stmt;
   }

   // Get The Search Data Of The Keyword Data Function
   private function search() {
      $keyValue = filter_var($_POST["keyword"], FILTER_SANITIZE_STRING);
      if($keyValue == "") {
         $stmt = $this->getInventoryData();
      } else {
         $keyword = "'%" . $keyValue . "%'";
         $stmt = $this->getSearchData($keyword);
      }

      return $stmt;
   }

   // Delete Item From Database
   private function deleteFromInve($id) {
      $con = $this->conectDataBase();
   
      $stmt = $con->prepare("DELETE FROM items WHERE Item_ID = '$id'");
      $stmt->execute();

      return $stmt;
   }

   // Insert The Edit's Into The Database
   private function insertEdit($id) {
      $con = $this->conectDataBase();
         
      $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
      $desc = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
      $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
      $que = filter_var($_POST['qua'], FILTER_SANITIZE_NUMBER_INT);
      $cat = filter_var($_POST['cat'], FILTER_SANITIZE_NUMBER_INT);

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

   // Insert The New Image Into Databse
   private function editImg($id) {
      $con = $this->conectDataBase();

      $stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = '$id'");
      $stmt->execute();
      $ftc = $stmt->fetch();
      
      $curent_imgs = $ftc['Images'];

      // I store the imges in the Database into Json Formate
      // For that you will be convert it to PHP Array to use the images
      $arr_imgs = json_decode($curent_imgs);

      $img = $_FILES['img']['name'];
      $img_tmp = $_FILES['img']['tmp_name'];

      $image = rand(0, 100000000) . "_" . $img;
      move_uploaded_file($img_tmp, '..\uploads\\' . $image);

      // Delete The Current Image
      unlink('../' . $arr_imgs[$_POST['posImg']]);

      $arr_imgs[$_POST['posImg']] = "uploads/" . $image;

      $imgs = json_encode($arr_imgs, JSON_UNESCAPED_SLASHES);

      $stmt = $con->prepare("UPDATE items SET Images = ? WHERE Item_ID = '$id'");
      $stmt->execute(array($imgs));

      // Output the New Images
      $stmt2 = $con->prepare("SELECT * FROM items WHERE Item_ID = '$id'");
      $stmt2->execute();
      $ftc2 = $stmt2->fetch();

      $new_images = json_decode($ftc2['Images']);
      $index = 0;
      foreach($new_images as $img) {
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
      }
   } 

   private function insertNewItem() {
      $con = $this->conectDataBase();
         
      $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
      $desc = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
      $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
      $que = filter_var($_POST['qua'], FILTER_SANITIZE_NUMBER_INT);
      $cat = filter_var($_POST['cat'], FILTER_SANITIZE_STRING);

      $errors = array();

      if(empty($name)) {
         $errors[] = "Please Enter The Name";
      } elseif (empty($desc)) {
         $errors[] = "Please Enter Description";
      } elseif(empty($price)) {
         $errors[] = "Please Enter Price";
      } elseif(empty($que)) {
         $errors[] = "Please Enter Quantity";
      } elseif ($cat == 'No Select') {
         $errors[] = "Please Select Category";
      } elseif (empty($_FILES)) {
         $errors[] = "Please Select Images";
      }

      foreach($errors as $error) {
         echo $error;
      }

      $imgAr = array();

      if(empty($errors)) {
         foreach($_FILES as $img) {
            $img_name = $img['name'];
            $img_tmp = $img['tmp_name'];
   
            $image = rand(0, 100000000) . "_" . $img_name;
            move_uploaded_file($img_tmp, '..\uploads\\' . $image);
   
            $imgAr[] = "uploads/" . $image;
         }
   
         $images = json_encode($imgAr);
         $stmt = $con->prepare("INSERT INTO items(Name, Description, Price, Images, Quantity, Category) VALUE(?, ?, ?, ?, ?, ?)");
         $stmt->execute(array($name, $desc, $price, $images, $que, $cat));
      }
   }
}
?>