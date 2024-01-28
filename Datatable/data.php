<?php
$conn = new mysqli("localhost", "root", "", "dataTable-db") or die("Connection failed");

$sql = "SELECT * FROM `dataTable`";
$result = mysqli_query($conn, $sql);

$data = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            'Id'   => $row['id'],
            'Name' => $row['name'],
            'Email' => $row['email'],
            'City' => $row['mycity']
            // Add other columns as needed
        );
    }
}

// Return the data as JSON
echo json_encode($data);
?>
