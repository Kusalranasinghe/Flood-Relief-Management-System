<?php

include 'database.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header text-center mb-5">
            <h2>Admin Management Portal</h2>
            <p>System Overview & Statistics</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h5>Total Users</h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
            </div>
            <div class="stat-card">
                <h5>Shelter Requests</h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM requests WHERE type = 'shelter' AND status = 'pending'");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
            </div>
            <div class="stat-card">
                <h5>Water Requests</h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM requests WHERE type = 'water' AND status = 'pending'");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
            </div>
            <div class="stat-card">
                <h5>Food Requests</h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM requests WHERE type = 'food' AND status = 'pending'");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
            </div>
        </div>

        <div class="mt-4">
            <?php include 'sumlocations.php'; ?>
        </div>

        <div class="mt-4">
            <?php include 'reliefhistory.php'; ?>
        </div>

        <div class="mt-5 text-center">
            <a href="requestdashboard.php" class="btn btn-primary px-4 py-2 m-2">Manage Requests</a>
            <a href="viewusers.php" class="btn btn-secondary px-4 py-2 m-2">View Registered Users</a>
            <a href="logout.php" class="btn btn-danger px-4 py-2 m-2">Logout System</a>
        </div>
    </div>
</body>

</html>