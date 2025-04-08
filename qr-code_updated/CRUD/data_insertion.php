<?php
require_once "db.php";

// Count entries and generate student_id
$result = $conn->query("SELECT COUNT(*) AS total FROM data");
$row = $result->fetch_assoc();
$ID = $row['total'] + 1;

$student_id = "2025-" . str_pad($ID, 4, "0", STR_PAD_LEFT);
$fullName = $_POST['fullName'];

// Insert into DB
$sql = "INSERT INTO data (student_id, fullName) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $student_id, $fullName);

if ($stmt->execute()) {
    // QR Code Generation (embed the student ID or URL/data in it)
    $qrData = urlencode($student_id);
    $qrCodeURL = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={$qrData}";

    echo "<h3>Registration Successful!</h3>";
    echo "<p><strong>Student ID:</strong> $student_id</p>";
    echo "<p><strong>Name:</strong> $fullName</p>";
    echo "<p><strong>QR Code:</strong></p>";
    echo "<img src='$qrCodeURL' alt='QR Code'>";
    echo "<br>";
    echo "<br>";
    echo "<a href='../index.php'>Go Back To Register</a>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
