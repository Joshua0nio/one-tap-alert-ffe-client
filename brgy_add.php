<?php
include "includes/conn.php";

if (isset($_POST['Submit'])) {
  $name = $_POST['name'];
  $tag = $_POST['tag'];

  $sql = "SELECT * FROM barangays WHERE name = '$name'";
  $query = $conn->query($sql);
  if ($query->num_rows < 1) {
    $_SESSION['error'] = 'Barnagay not found';
  } else {
    $row = $query->fetch_assoc();
    $name = $row['name'];
    $sql = "INSERT INTO barangays (name, tag, date_added) VALUES ('$name', '$tag', NOW())";
    if ($conn->query($sql)) {
      $_SESSION['success'] = 'Barangay added successfully';
    } else {
      $_SESSION['error'] = $conn->error;
    }
  }

  header("Location: barangays.php");
} else {
  $_SESSION['error'] = 'Fill up add form first';
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