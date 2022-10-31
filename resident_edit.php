<?php include 'includes/session.php'; ?>
<?php
// including the database connection file
include_once("includes/conn.php");

if (isset($_POST['update'])) {
  $user_id = $_POST['id'];
  $usertypes = $_POST['role'];
  $firstname = $_POST['firstname'];
  $middleInitial = $_POST['MI'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $brgy = $_POST['barangay'];
  $city = $_POST['city'];
  $contact = $_POST['contactno'];
  $zipcode = $_POST['zip'];

  // checking empty fields
  if (empty($usertypes) || empty($firstname) || empty($middleInitial) || empty($lastname) || empty($email) || empty($brgy) || empty($city) || empty($contact) || empty($zipcode)) {
    if (empty($usertypes)) {
      echo "<font color='red'>role field is empty.</font><br/>";
    }

    if (empty($firstname)) {
      echo "<font color='red'>first name field is empty.</font><br/>";
    }

    if (empty($middleInitial)) {
      echo "<font color='red'>Middle Initial field is empty.</font><br/>";
    }
    if (empty($lastname)) {
      echo "<font color='red'>Last Name field is empty.</font><br/>";
    }

    if (empty($email)) {
      echo "<font color='red'>Email field is empty.</font><br/>";
    }

    if (empty($brgy)) {
      echo "<font color='red'>Barangay field is empty.</font><br/>";
    }
    if (empty($city)) {
      echo "<font color='red'>city field is empty.</font><br/>";
    }

    if (empty($contact)) {
      echo "<font color='red'>Contact field is empty.</font><br/>";
    }

    if (empty($zipcode)) {
      echo "<font color='red'>Zip code field is empty.</font><br/>";
    }
  } else {
    //updating the table
    $result = mysqli_query($conn, "UPDATE users SET user_type_id='$usertypes',first_name='$firstname', middle_initial='$middleInitial', last_name = '$lastname', email_address='$email', barangay_id='$brgy', city='$city', contact_no='$contact', zip_code = '$zipcode' WHERE id=$user_id");

    //redirectig to the display page. In our case, it is index.php
    header("Location: resident.php");
  }
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($conn, " SELECT u.id, u.user_type_id AS Roles, u.first_name, u.middle_initial, u.last_name, u.contact_no, u.email_address, u.address,u.barangay_id AS bID, u.city,u.zip_code, u.date_added, b.name AS barangay_name, s.name AS status, ut.name AS role_name FROM users u LEFT JOIN barangays AS b ON u.barangay_id = b.id LEFT JOIN user_statuses AS s ON u.user_status_id = s.id LEFT JOIN user_types AS ut ON u.user_type_id = ut.id WHERE u.user_type_id = 2 AND u.id = '$id'");

while ($row = mysqli_fetch_array($result)) {
  $usertypesid = $row['Roles'];
  $usertypes = $row['role_name'];
  $firstname = $row['first_name'];
  $middleInitial = $row['middle_initial'];
  $lastname = $row['last_name'];
  $email = $row['email_address'];
  $address = $row['address'];
  $brgyID = $row['bID'];
  $brgy = $row['barangay_name'];
  $city = $row['city'];
  $contact = $row['contact_no'];
  $zipcode = $row['zip_code'];
}
?>
<?php include "navbars.php"; ?>

<body class="bg-gradient-login">

  <!-- Login Content -->
  <div class="container-login">

    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-left">
                    <h1 class="h1 text-gray-900 mb-4">Edit <?php echo $firstname . ' ' . $middleInitial . ' ' . $lastname; ?></h1>
                  </div>
                  <form action="resident_edit.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label>Roles:</label>
                    <div class="form-group">
                      <select class="form-control" name="role" aria-label="Default select example">
                        <option value="<?php echo $usertypesID; ?>"><?php echo $usertypes; ?></option>
                        <?php
                        $sql = "SELECT * FROM user_types";
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
                    <hr>
                    <div class="input-group">
                      <span class="input-group-text">Name:</span>
                      <input type="text" name="firstname" aria-label="First name" value="<?php echo $firstname; ?>" class="form-control" required>
                      <input type="text" name="MI" aria-label="M.I." value="<?php echo $middleInitial; ?>" class="form-control" required>
                      <input type="text" name="lastname" aria-label="Last name" value="<?php echo $lastname; ?>" class="form-control" required>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="form-group">
                      <label>Contact No.</label>
                      <input type="Text" name="contactno" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $contact; ?>" required>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" name="address" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $address; ?>" required>
                    </div>
                    <label>Barangay</label>
                    <div class="form-group">
                      <select class="form-control" name="barangay" aria-label="Default select example">
                        <option value="<?php echo $brgyID; ?>"><?php echo $brgy; ?></option>
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
                      <input type="text" name="city" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $city; ?>" required>
                    </div>
                    <div class="form-group">
                      <label>Zip Code</label>
                      <input type="text" name="zip" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $zipcode; ?>" required>
                    </div>

                    <input type="submit" name="update" class="btn btn-success btn-sm btn-flat" value="Update">
                    <a href="resident.php" class="btn btn-danger btn-sm  btn-flat"> Close </a>
                  </form>
                  <hr>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>