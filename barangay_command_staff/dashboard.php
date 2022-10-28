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
                <a href="resident.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="responder.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="brgystaff.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
    <div class="col-xl-14 col-lg-10">
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
              <div id="legend" class="text-center"></div>
              <canvas id="barChart" style="height:300px"></canvas>
            </div>
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
<?php
$and = 'AND YEAR(date_added) = ' . $year;
$months = array();
$fire = array();
$flood = array();
$earthquake = array();
$notresponded = array();
for ($m = 1; $m <= 12; $m++) {
  $sql = "SELECT * FROM emergencies e WHERE MONTH(e.date_added) = '$m' AND e.emergency_status_id = '3' $and AND e.emergency_type_id = '1'";
  $oquery = $conn->query($sql);
  array_push($fire, $oquery->num_rows);

  $sql = "SELECT * FROM emergencies e WHERE MONTH(e.date_added) = '$m' AND e.emergency_status_id = '3' $and AND e.emergency_type_id = '2'";
  $lquery = $conn->query($sql);
  array_push($flood, $lquery->num_rows);

  $sql = "SELECT * FROM emergencies e WHERE MONTH(e.date_added) = '$m' AND e.emergency_status_id = '3' $and AND e.emergency_type_id = '3'";
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
  $(function() {
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChart = new Chart(barChartCanvas)
    var barChartData = {
      labels: <?php echo $months; ?>,
      datasets: [{
          label: 'Fire',
          fillColor: 'rgba(210, 214, 222, 1)',
          strokeColor: 'rgba(210, 214, 222, 1)',
          pointColor: 'rgba(210, 214, 222, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: <?php echo $fire; ?>
        },
        {
          label: 'Flood',
          fillColor: 'rgba(60,141,188,0.9)',
          strokeColor: 'rgba(60,141,188,0.8)',
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: <?php echo $flood; ?>
        },
        {
          label: 'Earthquake',
          fillColor: 'rgba(60,141,188,0.9)',
          strokeColor: 'rgba(60,141,188,0.8)',
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: <?php echo $earthquake; ?>
        },
        {
          label: 'Not Responded',
          fillColor: 'rgba(60,141,188,0.9)',
          strokeColor: 'rgba(60,141,188,0.8)',
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: <?php echo $notresponded; ?>
        }
      ]
    }
    barChartData.datasets[1].fillColor = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor = '#00a65a'
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    }

    barChartOptions.datasetFill = false
    var myChart = barChart.Bar(barChartData, barChartOptions)
    document.getElementById('legend').innerHTML = myChart.generateLegend();
  });
</script>
</body>

</html>