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
      </div>
    </div>

  </div>

</div>
<!--Row-->
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">Marker Google Maps</div>
      <div class="panel-body">
        <div id="mapCanvas" style="width: 700px; height: 600px;"></div>
      </div>
    </div>
  </div>
</div>

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBY02OUe-MycQkDSpFvc3w9Qrab5mA7uz4&callback=initMap"></script>
<!-- Page level custom scripts -->
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover').DataTable(); // ID From dataTable with Hover
  });
</script>
<script>
  function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
      mapTypeId: 'roadmap'
    };

    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(100);

    // Multiple markers location, latitude, and longitude
    var markers = [
      <?php
      $result = mysqli_query($conn, "select *, e.user_id, e.emergency_type_id, e.longitude, e.latitude, e.emergency_status_id, u.first_name, u.lastname, u.user_type_id, et.name AS disaster,  es.name AS status from emergencies e LEFT JOIN users u ON e.user_id = u.id LEFT JOIN emergency_types et ON e.emergency_type_id = et.id LEFT JOIN emergency_statuses es ON e.emergency_status_id = es.id WHERE u.user_type_id = 2 ");
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '["' . $row['first_name'] . '","' . $row['last_name'] . '", ' . $row['latitude'] . ', ' . $row['longitude'] . ', "' . $row['status'] . '"],';
        }
      }
      ?>
    ];

    // Info window content
    var infoWindowContent = [
      <?php if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) { ?>['<div class="info_content">' +
            '<h3><?php echo $row['first_name'] . ' ' . $row['middle_initial'] . ' ' . $row['last_name'];  ?></h3>' +
            '<p><?php echo $row['status']; ?></p>' + '</div>'],
      <?php }
      }
      ?>
    ];

    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(),
      marker, i;

    // Place each marker on the map  
    for (i = 0; i < markers.length; i++) {
      var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
      bounds.extend(position);
      marker = new google.maps.Marker({
        position: position,
        map: map,
        icon: markers[i][3],
        title: markers[i][0]
      });

      // Add info window to marker    
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infoWindow.setContent(infoWindowContent[i][0]);
          infoWindow.open(map, marker);
        }
      })(marker, i));

      // Center the map to fit all markers on the screen
      map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
      this.setZoom(14);
      google.maps.event.removeListener(boundsListener);
    });
  }

  // Load initialize function
  google.maps.event.addDomListener(window, 'load', initMap);
</script>

</body>

</html>