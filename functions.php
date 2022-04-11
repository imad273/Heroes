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

/* Set the Active Class in navbar as location */
function setStyleClass($link, $styles) {
   global $title;
   if($title == $link) {
      echo $styles;
   }
}

function formateDate($curDate, $time = false) {
   $cls = new DataBase();
   $con = $cls->_connect();

   if($time = true) {
      $time = '%k:%i%p';
   } else {
      $time = "";
   }

   $date = $con->prepare("SELECT DATE_FORMAT('$curDate', '%b %D, %Y $time') AS date");
   $date->execute();
   $ftc = $date->fetch();
   return $ftc['date'];
}

/* Get Data From Category Table */
function getCategoryData() {
   $cls = new DataBase();
   $con = $cls->_connect();

   $stmt = $con->prepare("SELECT * FROM categories");
   $stmt->execute();
   return $stmt;
}

/* Get Data From Users Table */
function getUsersData() {
   $cls = new DataBase();
   $con = $cls->_connect();

   $stmt = $con->prepare("SELECT * FROM Users WHERE isAdmin = 0");
   $stmt->execute();
   return $stmt;
}

/* Get Data From Massages Table */
function getMessages() {
   $cls = new DataBase();
   $con = $cls->_connect();

   $stmt = $con->prepare("SELECT * FROM messages ORDER BY Msg_id DESC");
   $stmt->execute();
   return $stmt;
}

function CountRows($column, $table){
   $cls = new DataBase();
   $con = $cls->_connect();

   $stmt = $con->prepare("SELECT COUNT($column) FROM $table");
   $stmt->execute();
   $ftc = $stmt->fetchColumn();
   return $ftc;
}

function SumRows($column, $table){
   $cls = new DataBase();
   $con = $cls->_connect();

   $stmt = $con->prepare("SELECT SUM($column) FROM $table");
   $stmt->execute();
   $ftc = $stmt->fetchColumn();
   return $ftc;
}

?>