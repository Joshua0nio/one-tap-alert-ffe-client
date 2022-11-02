
<?php
include('includes/conn.php');
$id = $_GET['id'];
$query = "UPDATE users SET user_status_id = '2'  WHERE id = '$id';";
if ($conn->query($query) === TRUE) {
  $_SESSION['success'] = 'Record Approved successfully';
} else {
  $_SESSION['error'] = $conn->error;
}

$conn->close();
header('location: barangayStaffapproval.php');

?>