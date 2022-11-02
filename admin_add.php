<?php include "navbars.php"; ?>
<?php

if (isset($_POST['Submit'])) {

  $usertypes = "1";
  $firstname = $_POST['firstname'];
  $middleInitial = $_POST['MI'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $password =  md5($_POST['pass']);
  $repassword =  md5($_POST['repass']);
  $email = $_POST['email'];
  $brgy = $_POST['barangay'];
  $city = $_POST['city'];
  $status = "2";
  $address = $_POST['address'];
  $contact = $_POST['contactno'];
  $zipcode = $_POST['zip'];

  $query = "INSERT INTO users(`email_address`,`contact_no`,`username`,`password`,`user_type_id`,`first_name`,`middle_initial`,`last_name`,`zip_code`,`address`,`barangay_id`,`city`,`user_status_id`)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'sssssssssssss', $email, $contact, $username, $password, $usertypes, $firstname, $middleInitial, $lastname, $zipcode, $address, $brgy,  $city, $status);

  if (mysqli_stmt_execute($stmt)) {
  } else {
    $_SESSION['error'] = $conn->error;
  }

  if (!mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Your account request is now pending for approval. Please wait for confirmation. Thank you.')</script>";
  } else {
    echo "<script>alert(" . $stmt->error . ")</script>";
  }
  header('location: admin_add.php');
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
                    <h1 class="h4 text-gray-900 mb-4">Add Admin</h1>
                  </div>
                  <form method="post" action="admin_add.php" enctype="multipart/form-data">

                    <div class="input-group">
                      <span class="input-group-text">Name:</span>
                      <input type="text" name="firstname" aria-label="First name" placeholder="First name" class="form-control">
                      <input type="text" name="MI" aria-label="M.I." placeholder="M.I." class="form-control">
                      <input type="text" name="lastname" aria-label="Last name" placeholder="Last name" class="form-control">
                    </div>
                    <hr>
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" name="username" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address">
                    </div>
                    <div class="form-group">
                      <label>Contact No.</label>
                      <input type="Text" name="contactno" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Contact Number">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="pass" class="form-control" id="exampleInputPassword" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                    </div>
                    <div class="form-group">
                      <label>Repeat Password</label>
                      <input type="password" name="repass" class="form-control" id="exampleInputPasswordRepeat" placeholder="Repeat Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                    </div>
                    <hr>
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" name="address" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Address">
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
                      <input type="text" name="city" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Zip Code">
                    </div>
                    <div class="form-group">
                      <label>Zip Code</label>
                      <input type="text" name="zip" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Zip Code">
                    </div>
                    <hr>
                    <div class="form-group">

                      <input type="submit" name="Submit" class="btn btn-success btn-sm btn-flat" value="Add Admin">
                      <a href="admin.php" class="btn btn-danger btn-sm  btn-flat"> Close </a>
                    </div>
                    <hr>

                  </form>


                </div>
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