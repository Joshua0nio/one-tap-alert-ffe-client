<?php include "navbars.php"; ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Residents Registration Approval</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item">Users Registration Approval</li>
      <li class="breadcrumb-item active" aria-current="page">Barangays Registration Approval</li>
    </ol>
  </div>

  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Barangay's Registration List</h6>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Contact No.</th>
              <th>Email Address</th>
              <th>Address</th>
              <th>Barangay</th>
              <th>City</th>
              <th>Zip Code</th>
              <th>Front ID</th>
              <th>Back ID</th>
              <th>Selfie</th>
              <th>Status</th>
              <th>Date Added</th>
              <th>Action</th>

            </tr>
          </thead>
          <tfoot>
            <tbody>
              <?php
              $sql = "SELECT
            u.id AS ID,
              u.first_name,
              u.middle_initial,
              u.last_name,
              u.contact_no,
              u.email_address,
              u.address,
              u.city,
              u.zip_code,
              u.captured_image_front_id,
              u.captured_image_back_id,
              u.captured_image_selfie,
              u.date_added,
              b.name AS barangay_name,
              s.name AS status
          FROM users u
          LEFT JOIN barangays AS b
            ON u.barangay_id = b.id
          LEFT JOIN user_statuses AS s
            ON u.user_status_id = s.id
          WHERE u.user_type_id = 4 AND user_status_id = 1;";
              $query = $conn->query($sql);
              while ($row = $query->fetch_assoc()) {
              ?>
                <tr>
                  <td><?php echo $row['ID']; ?></td>
                  <td><?php echo $row['first_name'] . ' ' . $row['middle_initial'] . ' ' . $row['last_name']; ?></td>
                  <td><?php echo $row['contact_no']; ?></td>
                  <td><?php echo $row['email_address']; ?></td>
                  <td><?php echo $row['address']; ?></td>
                  <td><?php echo $row['barangay_name']; ?></td>
                  <td><?php echo $row['city']; ?></td>
                  <td><?php echo $row['zip_code']; ?></td>
                  <td>
                    <img src="img/images/front/
<?php echo $row['captured_image_front_id']; ?>" style="width:100%;height:auto;" />
                  </td>

                  <td>
                    <img src="img/images/back
<?php echo $row['captured_image_back_id']; ?>" style="width:100%;height:auto;" />
                  </td>

                  <td>
                    <img src="img/images/photo/
<?php echo $row['captured_image_selfie']; ?>" style="width:100%;height:auto;" />
                  </td>
                  <td>
                    <?php echo $row['status']; ?>
                  </td>
                  <td><?php echo date('M d, Y', strtotime($row['date_added'])) ?></td>
                  <td>
                    <a href=" brgyStff_accept.php?id=<?php echo $row['ID'] ?>" class="btn btn-secondary my-2">Accept</a>
                    <a href=" reject.php?id=<?php echo $row['ID'] ?>" class="btn btn-secondary my-2">Reject</a>
                  </td>
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

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover').DataTable(); // ID From dataTable with Hover
  });
</script>

</body>

</html>


<?php
if (isset($_POST['reject'])) {
  $id = $_GET['id'];

  $query = "DELETE FROM users u WHERE u.id = '$id';";
  if ($conn->query($query) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}
$conn->close();
?>