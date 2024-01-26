<?php

$userId = $_POST['id'];
$userName = $_POST['name'];

$conn = new mysqli("localhost", "root", "", "ajax-db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use prepared statement to prevent SQL injection
$sql = "UPDATE `ajax-user` SET name=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $userName, $userId);  // "si" represents a string and an integer parameter
$result = $stmt->execute();
$stmt->close();
$conn->close();

if ($result) {
    echo 1;
} else {
    echo 0;
}

?>
