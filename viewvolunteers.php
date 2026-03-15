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
    <title>Registered Volunteers</title>
</head>

<body>

    <?php
    include 'admin_topbar.php';
    ?>

    <div class="dashboard-container">

        <!-- Header -->
        <div class="dashboard-header">
            <h2>Registered Volunteers</h2>
        </div>


        <!-- SECTION 2: Request Type Cards -->
        <div class="section-label"> Relief Requests by Type</div>
        <div class="stats-grid-4">
            <div class="stat-card">
                <h5> Food & Water Suppliers</h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM volunteers WHERE type = 'food' ");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
            </div>
            <div class="stat-card">
                <h5> Medicine Suppliers</h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM volunteers WHERE type = 'medicine' ");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
            </div>
            <div class="stat-card">
                <h5> Shelter Providers </h5>
                <?php
                $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM volunteers WHERE type = 'shelter' ");
                $data = mysqli_fetch_assoc($res);
                echo "<h2>" . $data['total'] . "</h2>";
                ?>
            </div>

        </div>

        <table class="custom-table w-100" id="historyTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>NIC</th>
                    <th>Telephone</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM volunteers";
                $result = mysqli_query($conn, $sql);
                $counter = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $counter++ . "</td>";
                    echo "<td>" . ucfirst($row['type']) . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['nic'] . "</td>";
                    echo "<td>+94" . $row['telephone'] . "</td>";
                    
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>





    </div>

    <script src="script.js"></script>

</body>

</html>