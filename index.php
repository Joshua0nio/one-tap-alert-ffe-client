<?php
session_start();
if (isset($_SESSION['users'])) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Login</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>
<?php
session_start();
//if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {   
?>
<style>
  body,
  html {
    height: 100%;
    margin: 0;
  }

  .bg {
    /* filter: blur(8px);
    -webkit-filter: blur(8px); */

    background-image: url("img/bg.jpg");

    /* Full height */
    height: 140%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>

<div class="bg">

  <body class="bg-gradient-login ">

    <!-- Login Content -->
    <div class="container-login">

      <div class="row justify-content-center ">

        <div class="col-xl-6 col-lg-12 col-md-9">
          <div class="card shadow-sm my-5">
            <div class="card-body p-0">
              <div class="row">
                <div class="col-lg-12">
                  <div class="login-form">
                    <center><img src="img/logo/logo.png" width="300px" height="300px"></center>
                    <div class="text-center">
                      <h1 class="h1 text-gray-900 mb-4">Login</h1>
                    </div>
                    <form class="user" action="login.php" method="POST">
                      <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username" name="username">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
                      </div>

                      <label>Roles:</label>
                      <div class="form-group">
                        <select class="form-control" aria-label="Default select example" name="role">
                          <option selected>Select your Role:</option>
                          <option value="1">Admin</option>
                          <option value="4">Barangay Staff</option>
                          <option value="5">Command Center Staff</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                          <input type="checkbox" class="custom-control-input" id="customCheck">
                          <label class="custom-control-label" for="customCheck">Remember
                            Me</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" name="submit" value="Login">
                      </div>
                      <hr>
                      <div class="text-center">
                        <?php if (isset($_GET['error'])) { ?>
                          <div class="alert alert-danger" role="alert">
                            <?= $_GET['error'] ?>
                          </div>
                        <?php } ?>
                    </form>
                    <hr>
                    <div class="text-center">
                      <a class="font-weight-bold small" href="register.php">Create an Account!</a>
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
</div>
<!-- Login Content -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
</body>

</html>
<?php
// } 
// else {
//   //header("Location: redirect.php");
// } 
?>