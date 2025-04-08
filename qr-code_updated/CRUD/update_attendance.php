<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $fullName = $_POST['fullName'];

    $stmt = $conn->prepare("UPDATE data SET fullName = ? WHERE student_id = ?");
    $stmt->bind_param("ss", $fullName, $student_id);

    if ($stmt->execute()) {
        header("Location: ../recordAttendance.php?msg=updated");
    } else {
        echo "Failed to update record.";
    }

    $stmt->close();
    $conn->close();
}
?>
