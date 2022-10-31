<?php include 'includes/session.php'; ?>
<?php
include "includes/conn.php";

if (isset($_POST['Submit'])) {
  $name = $_POST['name'];
  $tag = $_POST['tag'];


  $query = "INSERT INTO barangays(`name`, `tag`)VALUES(?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'ss', $name, $tag);

  if (mysqli_stmt_execute($stmt)) {

    echo "<script>alert('Your account request is now pending for approval. Please wait for confirmation. Thank you.')</script>";
  } else {
    $_SESSION['error'] = $conn->error;
  }

  if (!mysqli_stmt_execute($stmt)) {

    // }
    // if ($_FILES['photo']['name']) {
    //   move_uploaded_file($_FILES['photo']['tmp_name'], "/img/images/photo" . $_FILES['photo']['name']);
    //   $photo = "/img/images" . $_FILES['']['name'];
    //   $photoFileName = basename($_FILES['photo']['name']);
    // }

  } else {
    echo "<script>alert(" . $stmt->error . ")</script>";
  }
  header('location: barangays.php');
}

?>


<?php include "navbars.php"; ?>

<body class="bg-gradient-login">
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-left">
                    <h1 class="h1 text-gray-900 mb-4">ADD BARANGAY</h1>
                  </div>
                  <form action="brgy_add.php" method="POST">
                    <div class="form-group">
                      <label>Barangay Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Barangay Name">
                    </div>
                    <div class="form-group">
                      <label>Tag</label>
                      <input type="text" class="form-control" name="tag" placeholder="Enter Barangay Tag (Optional)">
                    </div>

                    <input type="submit" name="Submit" class="btn btn-success btn-sm btn-flat" value="Add Barangay">
                    <a href="barangays.php" class="btn btn-danger btn-sm  btn-flat"> Close </a>
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