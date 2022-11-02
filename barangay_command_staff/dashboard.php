<?php include "navbars.php"; ?>
<?php
include '../includes/timezone.php';
$today = date('Y-m-d');
$year = date('Y');
if (isset($_GET['year'])) {
  $year = $_GET['year'];
}
?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </div>

  <div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Fire</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                <?php
                $sql = "SELECT * FROM emergencies WHERE emergency_type_id = '1'";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>
              </div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <a href="fire.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Flood</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                <?php
                $sql = "SELECT * FROM emergencies WHERE emergency_type_id = '2'";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?></div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <a href="flood.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Earthquake</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                <?php
                $sql = "SELECT * FROM emergencies WHERE emergency_type_id = '3'";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>
              </div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <a href="earthquake.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Not Responded</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                <?php
                $sql = "SELECT * FROM emergencies WHERE emergency_status_id = '4'";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>
              </div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <a href="ccStaff.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Area Chart -->
    <!-- <div class="col-xl-14 col-lg-10">
      <div class="card mb-4">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Monthly Incident Reports</h3>
            <div class="box-tools pull-right">
              <form class="form-inline">
                <div class="form-group">
                  <label>Select Year: </label>
                  <select class="form-control input-sm" id="select_year">
                    <?php
                    for ($i = 2015; $i <= 2065; $i++) {
                      $selected = ($i == $year) ? 'selected' : '';
                      echo "
                            <option value='" . $i . "' " . $selected . ">" . $i . "</option>
                          ";
                    }
                    ?>
                  </select>
                </div>
              </form>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              <br>

              <canvas id="disaster" style="height:300px"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <div class="container-fluid pt-4 px-4">
      <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
          <div class="bg-body text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
              <h6 class="mb-0">Monthly Incident Reports</h6>
              <form class="form-inline">
                <div class="form-group">
                  <label>Select Year: </label>
                  <select class="form-control input-sm" id="select_year">
                    <?php
                    for ($i = 2015; $i <= 2065; $i++) {
                      $selected = ($i == $year) ? 'selected' : '';
                      echo "
                            <option value='" . $i . "' " . $selected . ">" . $i . "</option>
                          ";
                    }
                    ?>
                  </select>
                </div>
              </form>
            </div>
            <canvas id="disaster"></canvas>
          </div>
        </div>
        <div class="col-sm-12 col-xl-6">
          <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Pie Chart</h6>
            <canvas id="pie-chart"></canvas>
          </div>
        </div>
      </div>

    </div>
    <!-- Modal Logout -->


  </div>
  <!---Container Fluid-->
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
    </div>
  </div>

  <div class="container my-auto py-2">
    <div class="copyright text-center my-auto">

    </div>
  </div>
</footer>
<!-- Footer -->
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../js/ruang-admin.min.js"></script>
<script src="../vendor/chart.js/Chart.min.js"></script>
<script src="../js/demo/chart-area-demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="lib/chart/chart.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="js/main.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=visualization"></script>
<?php
$and = 'AND YEAR(date_added) = ' . $year;
$months = array();
$fire = array();
$flood = array();
$earthquake = array();
$notresponded = array();



for ($m = 1; $m <= 12; $m++) {
  $sql = "SELECT * FROM emergencies e WHERE MONTH(e.date_added) = '$m' AND e.emergency_status_id = '1' $and AND e.emergency_type_id = '1'";
  $oquery = $conn->query($sql);
  array_push($fire, $oquery->num_rows);

  $sql = "SELECT * FROM emergencies e WHERE MONTH(e.date_added) = '$m' AND e.emergency_status_id = '1' $and AND e.emergency_type_id = '2'";
  $lquery = $conn->query($sql);
  array_push($flood, $lquery->num_rows);

  $sql = "SELECT * FROM emergencies e WHERE MONTH(e.date_added) = '$m' AND e.emergency_status_id = '1' $and AND e.emergency_type_id = '3'";
  $lquery = $conn->query($sql);
  array_push($earthquake, $lquery->num_rows);

  $sql = "SELECT * FROM emergencies e WHERE MONTH(e.date_added) = '$m' AND e.emergency_status_id = '4' $and ";
  $lquery = $conn->query($sql);
  array_push($notresponded, $lquery->num_rows);

  $num = str_pad($m, 2, 0, STR_PAD_LEFT);
  $month =  date('M', mktime(0, 0, 0, $m, 1));
  array_push($months, $month);
}

$months = json_encode($months);
$fire = json_encode($fire);
$flood = json_encode($flood);
$earthquake = json_encode($earthquake);
$notresponded = json_encode($notresponded);

?>
<?php include '../includes/scripts.php'; ?>
<script>
  var ctx1 = $(" #disaster").get(0).getContext("2d");
  var myChart1 = new Chart(ctx1, {
    type: "bar",
    data: {
      labels: <?php echo $months; ?>,
      datasets: [{
        label: "Fire",
        data: <?php echo $fire; ?>,
        backgroundColor: "rgba(235, 22, 22, .7)"
      }, {
        label: "Flood",
        data: <?php echo $flood; ?>,
        backgroundColor: "rgba(235, 22, 22, .5)"
      }, {
        label: "Earthquake",
        data: <?php echo $earthquake; ?>,
        backgroundColor: "rgba(235, 22, 22, .3)"
      }]
    },
    options: {
      responsive: true
    }
  });
</script>
<script>
  $(function() {
    $('#select_year').change(function() {
      window.location.href = '../barangay_command_staff/dashboard.php?year=' + $(this).val();
    });
  });
</script>
<?php



?>
<script type="text/javascript">

</script>

</body>

</html>