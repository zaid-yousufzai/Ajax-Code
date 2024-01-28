<?php
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['city'])) {
    $userId = $_POST['id'];
    $userName = $_POST['name'];
    $userEmail = $_POST['email'];
    $userCity = $_POST['city'];

    // Assuming you have a database connection here
    $conn = new mysqli("localhost", "root", "", "dataTable-db") or die("Connection failed");

    $sql = "UPDATE `dataTable` SET name='$userName', email='$userEmail', mycity='$userCity' WHERE id=$userId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}
?>
