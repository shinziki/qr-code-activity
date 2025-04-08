<?php
require_once "db.php";

// Get the latest student_id
$sql = "SELECT student_id FROM data ORDER BY student_id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $lastId = $result->fetch_assoc()['student_id'];

    // Split the ID (e.g., 2025-0018)
    [$year, $num] = explode("-", $lastId);
    $newId = $year . '-' . str_pad((int)$num + 1, 4, '0', STR_PAD_LEFT);
} else {
    // If no records exist yet
    $newId = date("Y") . "-0001";
}

echo $newId;

$conn->close();
?>
