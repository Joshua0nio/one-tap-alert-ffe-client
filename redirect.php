
<?php
// this code is for redirecting to different pages if the credentials are correct.
session_start();
include "includes/conn.php";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
  //admin
  if ($_SESSION['role'] == '1') {
    header("Location: dashboard.php");
  }
  //student
  else if ($_SESSION['role'] == '4') {
    header("Location: barangay_command_staff/dashboard.php");
  } else if ($_SESSION['role'] == '5') {
    header("Location: barangay_command_staff/dashboard.php");
  }
  //parent
} else {
  header("Location:index.php");
} ?>