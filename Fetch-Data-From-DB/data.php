<?php
$conn = new mysqli("localhost", "root", "", "ajax-db") or die("Connection failed");

$sql = "SELECT * FROM `ajax-user`"; // Use backticks to escape the table name
$result = mysqli_query($conn, $sql);
$output = '';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Append each row to the $output variable
        $output .= " <tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
        </tr>";
    }

    echo $output;
}
?>
