<?php
// including the database connection file
include_once("includes/conn.php");

if (isset($_POST['update'])) {
  $id = $_POST['id'];

  $name = $_POST['name'];
  $tag = $_POST['tag'];

  // checking empty fields
  if (empty($name) || empty($tag)) {
    if (empty($name)) {
      echo "<font color='red'>Name field is empty.</font><br/>";
    }

    if (empty($tag)) {
      echo "<font color='red'>Tag field is empty.</font><br/>";
    }
  } else {
    //updating the table
    $result = mysqli_query($conn, "UPDATE barangays SET name='$name',tag='$tag' WHERE id=$id");

    //redirectig to the display page. In our case, it is index.php
    header("Location: barangays.php");
  }
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($conn, "SELECT * FROM barangays WHERE id=$id");

while ($row = mysqli_fetch_array($result)) {
  $name = $row['name'];
  $tag = $row['tag'];
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
                    <h1 class="h1 text-gray-900 mb-4">Edit <?php echo $name; ?></h1>
                  </div>
                  <form action="brgy_edit.php" method="POST">
                    <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
                    <div class="form-group">
                      <label>Barangay Name</label>
                      <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                      <label>Tag</label>
                      <input type="text" class="form-control" name="tag" value="<?php echo $tag; ?>(Optional)">
                    </div>

                    <input type="submit" name="update" class="btn btn-success btn-sm btn-flat" value="Update">
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