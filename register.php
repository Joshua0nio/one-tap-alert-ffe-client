<?php
session_start();
include "header.php";
include "includes/conn.php";
?>
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

  if ($_FILES['front']['name']) {
    move_uploaded_file($_FILES['front']['tmp_name'], "/img/images/front" . $_FILES['front']['name']);
    $front = "/img/images" . $_FILES['front']['name'];
  }
  if ($_FILES['back']['name']) {
    move_uploaded_file($_FILES['back']['tmp_name'], "/img/images/back" . $_FILES['back']['name']);
    $back = "/img/images" . $_FILES['back']['name'];
  }
  if ($_FILES['photo']['name']) {
    move_uploaded_file($_FILES['photo']['tmp_name'], "/img/images/photo" . $_FILES['photo']['name']);
    $photo = "/img/images" . $_FILES['photp']['name'];
  }
  $query = "INSERT INTO 'users' ('email_address', 'contact_no', 'username', 'password','user_type_id', 'first_name', 'middle_initial','last_name','zip_code', 'address', 'city', 'user_status_id', 'capture_image_front_id', 'capture_image_back_id', 'captured_image_selfie', 'date_added') VALUES ('$email', '$contact', '$username', '$password', '$usertypes', '$firstname','$middleInitial','$lastname','$zipcode', '$address','$city', '1', '$front', '$back', '$photo', CURRENT_TIMESTAMP)";
  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Your account request is now pending for approval. Please wait for confirmation. Thank you.')</script>";
  } else {
    echo "<script>alert('Unknown error occured.')</script>";
  }
}
?>

<body class="bg-gradient-login">
  <!-- Register Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                  </div>
                  <form>

                    <label>Roles:</label>
                    <div class="form-group">
                      <select class="form-control" name="role" aria-label="Default select example">
                        <option selected>Select your Role:</option>
                        <option value="3">Responder</option>
                        <option value="4">Barangay Staff</option>
                        <option value="5">Command Center Staff</option>
                      </select>
                    </div>
                    <hr>
                    <div class="input-group">
                      <span class="input-group-text">Name:</span>
                      <input type="text" name="firstname" aria-label="First name" placeholder="First name" class="form-control" required>
                      <input type="text" name="MI" aria-label="M.I." placeholder="M.I." class="form-control" required>
                      <input type="text" name="Lastname" aria-label="Last name" placeholder="Last name" class="form-control" required>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" name="username" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address" required>
                    </div>
                    <div class="form-group">
                      <label>Contact No.</label>
                      <input type="Text" name="contactno" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Contact Number" required>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="pass" class="form-control" id="exampleInputPassword" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <label>Repeat Password</label>
                      <input type="password" name="repass" class="form-control" id="exampleInputPasswordRepeat" placeholder="Repeat Password" required>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" name="address" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Address" required>
                    </div>
                    <label>Barangay</label>
                    <div class="form-group">
                      <select class="form-control" name="barangay" aria-label="Default select example">
                        <?php
                        $sql = "SELECT * FROM barangays";
                        $row = mysqli_query($conn, $sql);
                        while ($res = mysqli_fetch_array(
                          $row,
                          MYSQLI_ASSOC
                        )) :;
                        ?>
                          <option value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>

                        <?php endwhile; ?>
                      </select>

                    </div>
                    <div class="form-group">
                      <label>City</label>
                      <input type="text" name="city" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Zip Code" required>
                    </div>
                    <div class="form-group">
                      <label>Zip Code</label>
                      <input type="text" name="zip" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Zip Code" required>
                    </div>
                    <div class="form-group">
                      <span class="input-group-text">NOTE: Please Upload your ID that proves that you are a staff or rescuer on mandaluyong city and also upload your Photo For confirmation</span>
                      <label>Front ID</label>
                      <input class="form-control" type="file" id="formFile" name='front'>
                      <label>Back ID</label>
                      <input class="form-control" type="file" id="formFile" name='back'>
                      <label>Your Photo</label>
                      <input class="form-control" type="file" id="formFile" name='photo'>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block" name="submit">Register</button>
                    </div>
                    <hr>

                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="index.php">Already have an account?</a>
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Register Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>