<?php

include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>User Details</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">


</head>

<body>
    <div class="container mt-5">
        <div class="dashboard-header mb-4">
            <h2>User Profile Report</h2>
            <p>Official Record for User ID: <?php echo $row['id']; ?></p>
        </div>

        <div class="table-card p-4">
            <table class="custom-table w-100">
                <tr><th width="30%">Full Name</th><td><?php echo $row['name']; ?></td></tr>
                <tr><th>NIC Number</th><td><?php echo $row['nic']; ?></td></tr>
                <tr><th>Email Address</th><td><?php echo $row['email']; ?></td></tr>
                <tr><th>Contact Number</th><td><?php echo $row['telephone']; ?></td></tr>
                <tr><th>District</th><td><?php echo $row['district']; ?></td></tr>
                <tr><th>Address</th><td><?php echo $row['address']; ?></td></tr>
            </table>

            <div class="mt-4 no-print">
                <a href="viewusers.php" class="btn btn-secondary">← Back to User List</a>
                <button onclick="window.print()" class="btn btn-primary">Print Report</button>
            </div>
        </div>
    </div>
</body>

</html>