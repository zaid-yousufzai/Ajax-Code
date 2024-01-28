<?php
if (isset($_POST['id'])) {
    $userId = $_POST['id'];

    // Assuming you have a database connection here
    $conn = new mysqli("localhost", "root", "", "dataTable-db") or die("Connection failed");

    $sql = "SELECT * FROM `dataTable` WHERE id = $userId";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        ?>
        <input type="hidden" id="idmodel" value="<?php echo $row['id']; ?>">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" id="namemodel" value="<?php echo $row['name']; ?>">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" id="emailmodel" value="<?php echo $row['email']; ?>">
        </div>
        <div class="mb-3">
            <label>City</label>
            <input type="text" class="form-control" id="citymodel" value="<?php echo $row['mycity']; ?>">
        </div>
        <button type="button" id="savemodel" class="btn btn-primary">Save changes</button>
        <?php
    }
}
?>
