<?php

// Script to connect to the database
require_once "config.php";

$id = $_GET['id'];

$q = "DELETE FROM `events` WHERE Sr_No = $id";
$q2 = "DELETE FROM `sold_tickets` WHERE Event_Number = $id";

$result = mysqli_query($conn, $q);
$result2 = mysqli_query($conn, $q2);

if($result && $result2) {
  $showAlert = true;
  $message = 'Event Deleted Successfully';
  header("Location: /WPL-Pro/admin.php?success=true&message= $message");
  exit();
}

?>