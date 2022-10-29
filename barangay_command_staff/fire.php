<?php include "navbars.php"; ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Fire Incident Reports</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item">Incident Reports</li>
      <li class="breadcrumb-item active" aria-current="page">Fire Incident Reports</li>
    </ol>
  </div>

  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Fire Incident Reports</h6>
      </div>
      <form>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <th>ID</th>
              <th>Resident Name</th>
              <th>Longitude</th>
              <th>Latitude</th>
              <th>Status</th>
              <th>Incident Date</th>
              </tr>
            </thead>
            <tfoot>
              <tbody>
                <?php

                $sql = "SELECT *, e.user_id, e.emergency_type_id, e.longitude, e.latitude, e.emergency_status_id, u.first_name, u.last_name, u.user_type_id, et.name AS disaster, es.name AS status FROM emergencies AS e LEFT JOIN users AS u ON e.user_id = u.id LEFT JOIN emergency_types AS et ON e.emergency_type_id = et.id LEFT JOIN emergency_statuses AS es ON e.emergency_status_id = es.id WHERE  e.emergency_type_id = '1'";
                $result = mysqli_query($conn, $sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['first_name'] . ' ' . $row['middle_initial'] . ' ' . $row['last_name']; ?></td>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBY02OUe-MycQkDSpFvc3w9Qrab5mA7uz4&callback=initMap" async defer></script>
<!-- Page level custom scripts -->
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover').DataTable(); // ID From dataTable with Hover
  });
</script>

</body>

</html>