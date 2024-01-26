<?php

$name = $_POST['name'];

// Use prepared statements to prevent SQL injection
$conn = new mysqli("localhost", "root", "", "ajax-db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `ajax-user` (name) VALUES (?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);  // "s" represents a string parameter
$result = $stmt->execute();
$stmt->close();
$conn->close();

if ($result) {
    echo 1;
} else {
    echo 0;
}
?>
