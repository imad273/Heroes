<?php

require "database.php";

/* Set Title of every page */
function setTitle() {
   global $title;
   if (isset($title)) {
      echo $title;
   } else {
      echo "No Title";
   }
}

/* Set the Active Class in navbar as location */
function setActiveClass($link) {
   global $title;
   if($title == $link) {
      echo "active";
   }
}

/* Get Data From Database */
function getData($table) {
   $cls = new DataBase();
   $con = $cls->_connect();

   $stmt = $con->prepare("SELECT * FROM $table");
   $stmt->execute();
   return $stmt;
}





?>