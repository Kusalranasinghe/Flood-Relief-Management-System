<?php
include 'database.php';
session_start();

define('INCLUDED', true);
define('ROW_LIMIT', 5);

if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Dashboard</title>
</head>

<body>

    <?php
    include 'admin_topbar.php';
    ?>

    <div class="dashboard-container">

        <div class="dashboard-header">
            <h2>Admin Management Portal</h2>
            <p>System Overview & Live Statistics</p>
        </div>

        <div class="section-label"> System Summary</div>
        <div class="stats-grid-2">
            <div class="stat-card">
                <h5>Total Registered Users</h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
            </div>
            <div class="stat-card urgent">
                <h5> High Severity Requests</h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM requests WHERE sev_level = 'high' AND status = 'pending';");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
                <small style="color:#fca5a5;font-size:12px;">Immediate attention required</small>
            </div>
        </div>

        <div class="section-label"> Relief Requests by Type</div>
        <div class="stats-grid-4">
            <div class="stat-card">
                <h5> Food Requests</h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM requests WHERE type = 'food' AND status = 'pending';");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
            </div>
            <div class="stat-card">
                <h5> Water Requests</h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM requests WHERE type = 'water' AND status = 'pending';");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
            </div>
            <div class="stat-card">
                <h5> Medicine Requests</h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM requests WHERE type = 'medicine' AND status = 'pending';");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
            </div>
            <div class="stat-card">
                <h5> Shelter Requests</h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM requests WHERE type = 'shelter' AND status = 'pending';");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
            </div>
        </div>

        <div class="section-label"> Pending Requests by District</div>
        <div class="dashboard-section">
            <?php include 'sumlocations.php'; ?>
            <div class="report-fade-link">
                <a href="sumlocations.php">View Full Report →</a>
            </div>
        </div>

        <div class="section-label"> Completed Relief History</div>
        <div class="dashboard-section">
            <?php include 'reliefhistory.php'; ?>
            <div class="report-fade-link">
                <a href="reliefhistory.php">View Full Report →</a>
            </div>
        </div>

    </div>

    <script src="script.js"></script>

</body>

</html>