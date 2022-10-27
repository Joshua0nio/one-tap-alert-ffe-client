
<?php
include('includes/conn.php');
$id = $_GET['id'];
$query = "UPDATE users SET user_status_id = '2'  WHERE id = '$id';";
if ($conn->query($query) === TRUE) {
  echo "<script>alert('Record has been Approved.')</script>";
} else {
  echo "<script>alert('Error Approving record:')</script> " . $conn->error;
}

$conn->close();
header('location: residentapproval.php');

?>

