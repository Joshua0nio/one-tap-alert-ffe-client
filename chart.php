<?php include "includes/conn.php"; ?>
<?php
include 'includes/timezone.php';
$today = date('Y-m-d');
$year = date('Y');
if (isset($_GET['year'])) {
  $year = $_GET['year'];
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Bargraph in PHP and MYSQL</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
  <div class="row">
    <div class="col-md-8 offset-md-2">
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
      <div class="card">
        <div class="card-header bg">
          <h1>Bargraph in PHP and MYSQL</h1>
        </div>
        <div class="card-body">
          <canvas id="chartjs_bar"></canvas>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

  <?php
  $and = 'AND YEAR(date_added) = ' . $year;
  $months = array();
  $fire = array();
  $flood = array();
  $earthquake = array();
  $notresponded = array();
  for ($m = 1; $m <= 12; $m++) {
    $sql = "SELECT * FROM emergencies e WHERE MONTH(e.date_added) = '$m' AND e.emergency_status_id = 3 $and AND e.emergency_type_id = 1";
    $oquery = $conn->query($sql);
    array_push($fire, $oquery->num_rows);

    $sql = "SELECT * FROM emergencies e WHERE MONTH(e.date_added) = '$m' AND e.emergency_status_id = 3 $and AND e.emergency_type_id = 2";
    $lquery = $conn->query($sql);
    array_push($flood, $lquery->num_rows);

    $sql = "SELECT * FROM emergencies e WHERE MONTH(e.date_added) = '$m' AND e.emergency_status_id = 3 $and AND e.emergency_type_id = 3";
    $lquery = $conn->query($sql);
    array_push($earthquake, $lquery->num_rows);

    $sql = "SELECT * FROM emergencies e WHERE MONTH(e.date_added) = '$m' AND e.emergency_status_id = 4 $and ";
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
  <script type="text/javascript">
    $(function() {
      var barChartCanvas = $('#myBarChart').get(0).getContext('2d')
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
  </script>
</body>

</html>