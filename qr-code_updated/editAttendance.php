<?php
require_once "CRUD/db.php";

$studentId = isset($_GET['student_id']) ? $_GET['student_id'] : '';

if ($studentId === '') {
    die("No student ID provided.");
}

// Fetch student details
$stmt = $conn->prepare("SELECT * FROM data WHERE student_id = ?");
$stmt->bind_param("s", $studentId);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

if (!$student) {
    die("Student not found.");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Edit Attendance</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body class="bg-light">
        <div class="container mt-5">
            <h1 class="text-center mb-4">Edit Attendance</h1>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="CRUD/update_attendance.php" method="post">
                        <!-- Keep student_id hidden (if you don’t want to allow editing it) -->
                        <div class="mb-3">
                          <label class="form-label">Student ID</label>
                          <input type="text" name="student_id" class="form-control" value="<?= htmlspecialchars($student['student_id']) ?>" readonly>
                        </div>
                
                        <div class="mb-3">
                          <label class="form-label">Full Name</label>
                          <input type="text" name="fullName" class="form-control" value="<?= htmlspecialchars($student['fullName']) ?>" required>
                        </div>
                
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="recordAttendance.php" class="btn btn-secondary">Cancel</a>
                      </form>
                </div>
            </div>
        </div>
    </body>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function openQRCodeScanner() {
            window.location.href = "scanQRCode.html";
        }

        function openAttendance() {
            window.location.href = "recordAttendance.php";
        }
    </script>
</html>