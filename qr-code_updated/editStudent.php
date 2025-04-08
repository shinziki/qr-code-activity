<?php
require_once "CRUD/db.php";

$studentId = isset($_GET['student_id']) ? $_GET['student_id'] : '';

if ($studentId !== '') {
    $stmt = $conn->prepare("SELECT * FROM data WHERE student_id = ?");
    $stmt->bind_param("s", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
} else {
    die("No student ID provided.");
}
?>