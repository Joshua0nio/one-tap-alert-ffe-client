<?php include "navbars.php"; ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Resident FFE Emergency Taps/Request</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Resident FFE Emergency Taps</li>
    </ol>
  </div>

  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Resident FFE Emergency Taps/Request</h6>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <th>ID</th>
            <th>Name</th>
            <th>Disaster Type</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Status</th>
            <th>Incident Date</th>
            </tr>
          </thead>
          <tfoot>
            <tbody>
              <?php
              date_default_timezone_set("Asia/Manila");
              $date = date("Y-m-d");
              $time = date("H:i:s");

              $sql = "SELECT *, e.user_id, e.emergency_type_id, e.longitude, e.latitude, e.emergency_status_id, u.first_name, u.last_name, u.user_type_id, et.name AS disaster, es.name AS status FROM emergencies AS e LEFT JOIN users AS u ON e.user_id = u.id LEFT JOIN emergency_types AS et ON e.emergency_type_id = et.id LEFT JOIN emergency_statuses AS es ON e.emergency_status_id = es.id WHERE u.user_type_id = 2 AND e.date_added = '$date'";
              $result = mysqli_query($conn, $sql);
              while ($row = $result->fetch_assoc()) {
              ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['first_name'] . ' ' . $row['middle_initial'] . ' ' . $row['last_name']; ?></td>
                  <td><?php echo $row['disaster']; ?></td>
                  <td><?php echo $row['longitude']; ?></td>
                  <td><?php echo $row['latitude']; ?></td>
                  <td><?php echo $row['status']; ?></td>
                  <td><?php echo date('M d, Y', strtotime($row['date_added'])) ?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
        </table>
        <div class="row embed-responsive embed-responsive-100x400px">
          <div class="co l-md-8">
            <div class="panel panel-default">
              <div class="panel-body">
                <div id="map-canvas" style="width: 910px; height: 600px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
<!--Row-->


</div>
<!---Container Fluid-->

</div>

<!-- Footer -->

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
<!-- Page level plugins -->
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBY02OUe-MycQkDSpFvc3w9Qrab5mA7uz4&callback=initMap&v=weekly" defer></script>
<!-- Page level custom scripts -->
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover').DataTable(); // ID From dataTable with Hover
  });
</script>
<?php
date_default_timezone_set("Asia/Manila");
$date = date("Y-m-d");
$time = date("H:i:s");
$query =  $conn->query("SELECT *, e.user_id, e.emergency_type_id, e.longitude, e.latitude, e.emergency_status_id, u.first_name, u.last_name, u.user_type_id, et.name AS disaster, es.name AS status FROM emergencies AS e LEFT JOIN users AS u ON e.user_id = u.id LEFT JOIN emergency_types AS et ON e.emergency_type_id = et.id LEFT JOIN emergency_statuses AS es ON e.emergency_status_id = es.id WHERE u.user_type_id = 2 ");
//$number_of_rows = mysql_num_rows($db);  
//echo $number_of_rows;

while ($row = $query->fetch_assoc()) {
  $name = $row['first_name'] . ' ' . $row['middle_initial'] . ' ' . $row['last_name'];
  $longitude = $row['longitude'];
  $latitude = $row['latitude'];
  /* Each row is added as a new array */
  $locations[] = array('name' => $name, 'lat' => $latitude, 'lng' => $longitude);
}
?>
<script type="text/javascript">
  var map;
  var Markers = {};
  var infowindow;
  var locations = [
    <?php for ($i = 0; $i < sizeof($locations); $i++) {
      $j = $i + 1; ?>[
        'AMC Service',
        '<p><a href="<?php echo $locations[0]['lnk']; ?>">Book this Person Now</a></p>',
        <?php echo $locations[$i]['lat']; ?>,
        <?php echo $locations[$i]['lng']; ?>,
        0
      ] <?php if ($j != sizeof($locations)) echo ",";
      } ?>
  ];
  var origin = new google.maps.LatLng(locations[0][2], locations[0][3]);

  function initialize() {
    var mapOptions = {
      zoom: 9,
      center: origin
    };

    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    infowindow = new google.maps.InfoWindow();

    for (i = 0; i < locations.length; i++) {
      var position = new google.maps.LatLng(locations[i][2], locations[i][3]);
      var marker = new google.maps.Marker({
        position: position,
        map: map,
      });
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][1]);
          infowindow.setOptions({
            maxWidth: 200
          });
          infowindow.open(map, marker);
        }
      })(marker, i));
      Markers[locations[i][4]] = marker;
    }

    locate(0);

  }

  function locate(marker_id) {
    var myMarker = Markers[marker_id];
    var markerPosition = myMarker.getPosition();
    map.setCenter(markerPosition);
    google.maps.event.trigger(myMarker, 'click');
  }

  google.maps.event.addDomListener(window, 'load', initialize);
</script>

</body>

</html>

<!-- <script>
  // Initialize and add the map
  function initMap() {
    // The location of Uluru
    const uluru = {
      lat: 14.5794,
      lng: 121.0359
    };

    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 15,
      center: uluru,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
      position: uluru,
      map: map,
    });
  }

  window.initMap = initMap;
</script> -->