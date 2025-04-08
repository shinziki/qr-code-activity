<?php
require_once "CRUD/db.php";

$student_id = $_POST['student_id'];

// Check if school_id exists
$sql = "SELECT fullName FROM data WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $fullName = $row['fullName'];

    // Insert into history
    $insert = $conn->prepare("INSERT INTO history (student_id) VALUES (?)");
    $insert->bind_param("s", $student_id);
    $insert->execute();

    echo "<p><strong>Student ID:</strong> $student_id</p>";
    echo "<p><strong>Full Name:</strong> $fullName</p>";
    echo "<p><strong>Status:</strong> Scanned and logged!</p>";
} else {
    echo "<p style='color: red;'>No matching data found.</p>";
}

$stmt->close();
$conn->close();
?>

