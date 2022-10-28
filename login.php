<?php

//login login 
session_start();
include "includes/conn.php";
if (isset($_POST['submit'])) {

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $username = test_input($_POST['username']);
  $password = test_input($_POST['password']);
  $role = test_input($_POST['role']);

  if (empty($username)) {
    header("Location: index.php?error=User Name is Required");
  } else if (empty($password)) {
    header("Location: index.php?error=Password is Required");
  } else {

    // Hashing function
    $password = md5($password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND user_status_id = '2'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      if ($row['password'] == $password && $row['user_type_id'] == $role) {
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['user_type_id'];
        $_SESSION['username'] = $row['username'];

        if ($row['user_type_id'] == 1) {
          header("Location: dashboard.php");
        } else if ($row['user_type_id'] == 4) {
          header("Location: barangay_command_staff/dashboard.php");
        } else if ($row['user_type_id'] == 5) {
          header("Location: barangay_command_staff/dashboard.php");
        }
      } else {
        header("Location: index.php?error=Incorect User name or password");
      }
    } else {
      header("Location: index.php?error=Incorect User name or password");
    }
  }
} else {
  header("Location: index.php");
}

 // echo $_POST['username'];
