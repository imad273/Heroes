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

function formateDate($curDate) {
   $cls = new DataBase();
   $con = $cls->_connect();
   $date = $con->prepare("SELECT DATE_FORMAT('$curDate', '%b %D, %Y') AS date");
   $date->execute();
   $ftc = $date->fetch();
   return $ftc['date'];
}

/* Get Data From Database */
function getCategoryData() {
   $cls = new DataBase();
   $con = $cls->_connect();

   $stmt = $con->prepare("SELECT * FROM categories");
   $stmt->execute();
   return $stmt;
}

function getUsersData() {
   $cls = new DataBase();
   $con = $cls->_connect();

   $stmt = $con->prepare("SELECT * FROM Users WHERE GroupID = 0");
   $stmt->execute();
   return $stmt;
}

?>