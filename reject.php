
<?php
include('includes/conn.php');
$id = $_GET['id'];

$query = "DELETE FROM users u WHERE u.id = '$id';";
if ($conn->query($query) === TRUE) {
  echo "<script>alert('Record has been deleted.')</script>";
} else {
  echo "<script>alert('Error deleting record:')</script> " . $conn->error;
}

$conn->close();
header('location: residentapproval.php');
