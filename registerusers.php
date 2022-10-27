<?php include "includes/conn.php"; ?>

<?php
if (isset($_POST['submit'])) {

  $usertypes = $_POST['role'];
  $firstname = $_POST['firstname'];
  $middleInitial = $_POST['MI'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $password = $_POST['pass'];
  $repassword = $_POST['repass'];
  $email = $_POST['email'];
  $brgy = $_POST['barangay'];
  $city = $_POST['city'];
  $contact = $_POST['contactno'];
  $zipcode = $_POST['zip'];
  $photo1 = $_FILES['front']['name'];
  $photo2 = $_FILES['back']['name'];
  $photo3 = $_FILES['photo']['name'];
  if (!empty($photo)) {
    move_uploaded_file($_FILES['front']['tmp_name'], '/img/images/' . $photo);
    $filename1 = $photo1;
  } else {
    $filename1 = $user['front'];
  }
  if (!empty($photo2)) {
    move_uploaded_file($_FILES['back']['tmp_name'], '/img/images/' . $photo2);
    $filename2 = $photo2;
  } else {
    $filename2 = $user['back'];
  }
  if (!empty($photo3)) {
    move_uploaded_file($_FILES['photo']['tmp_name'], '/img/images/' . $photo3);
    $filename3 = $photo3;
  } else {
    $filename3 = $user['photo'];
  }
  $query = "INSERT INTO 'users' ('email_address', 'contact_no', 'username', 'password','user_type_id', 'first_name', 'middle_initial','last_name','zip_code', 'address', 'city', 'user_status_id', 'capture_image_front_id', 'capture_image_back_id', 'captured_image_selfie', 'date_added') VALUES ('$email', '$contact', '$username', '$password', '$usertypes', '$firstname','$middleInitial','$lastname','$zipcode', '$address','$city', '1', '$filename1', '$filename2', '$filename3',CURRENT_TIMESTAMP)";
  if (mysqli_query($conn->query($query) === TRUE) {
    echo "<script>alert('Your account request is now pending for approval. Please wait for confirmation. Thank you.')</script>";
  } else {
    echo "<script>alert('Unknown error occured.')</script>";
  }
}
?>