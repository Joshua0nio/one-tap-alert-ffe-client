
<?php
// this code is for redirecting to different pages if the credentials are correct.
session_start();
include "includes/conn.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
  //admin
  if ($_SESSION['role'] == '1') {
    header("Location: barangay_staff/dashboard.php");
  }
  //student
  else if ($_SESSION['role'] == '4') {
    header("Location: barangay_staff/dashboard.php");
  }
  //parent
  else if ($_SESSION['role'] == '5') {
    header("Location: command_center/dashboard.php");
  }
} else {
  header("Location:index.php");
} ?>