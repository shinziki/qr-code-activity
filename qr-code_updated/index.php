<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body class="bg-light">
        <div class="container mt-5">
            <h1 class="text-center mb-4">Student Registration</h1>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="CRUD/data_insertion.php" method="post">
                        <?php
                        // Fetch next ID using same logic as get_next_id.php
                        require_once "CRUD/db.php";
                        $sql = "SELECT student_id FROM data ORDER BY student_id DESC LIMIT 1";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $lastId = $result->fetch_assoc()['student_id'];
                            [$year, $num] = explode("-", $lastId);
                            $newId = $year . '-' . str_pad((int)$num + 1, 4, '0', STR_PAD_LEFT);
                        } else {
                            $newId = date("Y") . "-0001";
                        }
                        $conn->close();
                        ?>

                        <div class="mb-3">
                            <label class="form-label">Student ID: </label>
                            <input type="text" name="student-id" class="form-control" value="<?= $newId ?>" disabled>
                            <input type="text" name="student-id" value="<?= $newId ?>" hidden>
                        </div>

                        <div class="mb-3">
                            <label>Fullname: </label>
                            <input type="text" name="fullName" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>

                    <div class="mt-4 text-center">
                        <button onclick="openQRCodeScanner()" class="btn btn-secondary mt-2">Scan QR Code</button>
                        <button onclick="openAttendance()" class="btn btn-info mt-2">View Attendance</button>
                    </div>
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