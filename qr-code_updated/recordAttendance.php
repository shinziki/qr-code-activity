<?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
  <div class="alert alert-success text-center" role="alert">
    Student info successfully updated!
  </div>
<?php endif; ?>

<?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
  <div class="alert alert-danger text-center" role="alert">
    Student record deleted successfully.
  </div>
<?php endif; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Attendance Records</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
  <div class="container mt-5">

    <h2 class="text-center mb-4">Attendance Records</h2>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Student ID</th>
            <th>Full Name</th>
            <th>Attendance</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once "CRUD/db.php";

          $sql = "
            SELECT 
              data.student_id, 
              data.fullName, 
              history.id,
              history.scan_time 
            FROM 
              history 
            JOIN 
              data ON history.student_id = data.student_id 
            ORDER BY history.scan_time ASC
          ";

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $formatted = date("F j, Y h:i:s A", strtotime($row['scan_time']));
              echo "<tr>
                      <td>{$row['id']}</td>
                      <td>{$row['student_id']}</td>
                      <td>{$row['fullName']}</td>
                      <td>$formatted</td>
                      <td>
                        <a href='editAttendance.php?student_id={$row['student_id']}' class='btn btn-sm btn-warning me-2'>Edit</a>
                        <a href='CRUD/delete_attendance.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                      </td>
                    </tr>"; 
            }
          } else {
            echo "<tr><td colspan='3'>No attendance records found.</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>

    <div class="mt-4 text-center">
            <button onclick="backToRegister()" class="btn btn-info mt-2">Go Back to Register</button>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

<script>
  function backToRegister() {
      window.location.href = "index.php";
  }
</script>
</html>
