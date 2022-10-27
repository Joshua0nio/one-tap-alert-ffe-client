<?php include "navbars.php"; ?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <?php
  if (isset($_SESSION['error'])) {
    echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
    unset($_SESSION['error']);
  }
  if (isset($_SESSION['success'])) {
    echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
    unset($_SESSION['success']);
  }
  ?>
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Barangays</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item"></li>
      <li class="breadcrumb-item active" aria-current="page">barangays</li>
    </ol>
  </div>

  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Barangay's List</h6>
      </div>
      <div class="col-lg-12">
        <a href="brgy_add.php" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tbody>
              <?php
              $sql = "SELECT
            b.id,
            b.name
            FROM barangays b";
              $query = $conn->query($sql);
              while ($row = $query->fetch_assoc()) {
              ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td>
                    <a href=" brgy_edit.php?id=<?php echo $row['id'] ?>" class="btn btn-success btn-sm edit btn-flat"><i class="fa fa-edit"></i>Edit</a>
                    <a href=" brgy_delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm  btn-flat"><i class="fa fa-trash"></i> Delete</a>
                    </form>
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
</div>
</div>
<!--Row-->
</div>
<!---Container Fluid-->
</div>

<!-- Footer -->

<!-- Footer -->
</div>
<?php include 'includes/brgy_modal.php'; ?>
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


<script>
  $(document).ready(function() {
    $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover').DataTable(); // ID From dataTable with Hover
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>