<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection here
    $conn = new mysqli("localhost", "root", "", "dataTable-db") or die("Connection failed");

    // Check if 'name', 'email', and 'city' keys exist in $_POST
    $name = isset($_POST['nameadd']) ? $_POST['nameadd'] : null;
    $email = isset($_POST['emailadd']) ? $_POST['emailadd'] : null;
    $city = isset($_POST['cityadd']) ? $_POST['cityadd'] : null;

    // Check if all required data is set
    if ($name !== null && $email !== null && $city !== null) {
        $sql = "INSERT INTO `dataTable` (name, email, mycity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $city);
        $stmt->execute();

        echo 1; // You can return a success message if needed
    } else {
        echo "Invalid data"; // Handle the case where 'name', 'email', or 'city' is missing
    }
} else {
    echo 0; // Handle the case where the request method is not POST
}
?>
