<?php

// Script to connect to the database
require_once "config.php";

$id = $_GET['id'];

$q = "DELETE FROM `events` WHERE Sr_No = $id";

$result = mysqli_query($conn, $q);

if($result){
  $showAlert = true;
  $message = 'Event Deleted Successfully';
  header("Location: /WPL-Pro/admin.php?success=true&message= $message");
  exit();
}

?>