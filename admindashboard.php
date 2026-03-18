<?php
include 'database.php';
session_start();

define('INCLUDED', true);
define('ROW_LIMIT', 5);

if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit;
}

$foodCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending' AND type='food'"))['c'];
$waterCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending' AND type='water'"))['c'];
$medicineCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending' AND type='medicine' "))['c'];
$shelterCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending' AND type='shelter'"))['c'];

$lowCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending' AND sev_level='low'"))['c'];
$medCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending' AND sev_level='medium'"))['c'];
$highCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending' AND sev_level='high'"))['c'];

$pendingCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending'"))['c'];
$acceptedCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='accepted'"))['c'];
$rejectedCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='rejected'"))['c'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        <div class="section-label"> Visual Analytics</div>
        <div class="dashboard-section">
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:30px;align-items:center;max-width:900px;margin:0 auto;">

                <!--chart by type-->
                <div style="text-align:center;">
                    <p style="color:#f97316;font-size:13px;font-weight:600;margin-bottom:12px;letter-spacing:0.5px;">REQUESTS BY TYPE</p>
                    <canvas id="typeChart" height="180"></canvas>
                </div>

                <!--chart by severity-->
                <div style="text-align:center;">
                    <p style="color:#f97316;font-size:13px;font-weight:600;margin-bottom:12px;letter-spacing:0.5px;">REQUESTS BY SEVERITY</p>
                    <canvas id="severityChart" height="180"></canvas>
                </div>

                <!--chart by status-->
                <div style="text-align:center;">
                    <p style="color:#f97316;font-size:13px;font-weight:600;margin-bottom:12px;letter-spacing:0.5px;">REQUESTS BY STATUS</p>
                    <canvas id="statusChart" height="180"></canvas>
                </div>

            </div>
        </div>

        <script>
            Chart.defaults.color = 'rgba(255,255,255,0.6)';
            Chart.defaults.font.family = 'Arial';
            Chart.defaults.font.size = 12;

            const chartOptions = {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'rgba(255,255,255,0.7)',
                            padding: 15,
                            font: {
                                size: 12
                            },
                            boxWidth: 12,
                            boxHeight: 12
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15,23,42,0.9)',
                        titleColor: '#f97316',
                        bodyColor: 'rgba(255,255,255,0.8)',
                        borderColor: 'rgba(249,115,22,0.3)',
                        borderWidth: 1,
                        padding: 10
                    }
                },
                cutout: '65%'
            };


            new Chart(document.getElementById('typeChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Food', 'Water', 'Medicine', 'Shelter'],
                    datasets: [{
                        data: [<?php echo $foodCount; ?>, <?php echo $waterCount; ?>, <?php echo $medicineCount; ?>, <?php echo $shelterCount; ?>],
                        backgroundColor: [
                            'rgba(249, 115, 22, 0.75)',
                            'rgba(96, 165, 250, 0.75)',
                            'rgba(52, 211, 153, 0.75)',
                            'rgba(251, 191, 36, 0.75)'
                        ],
                        borderColor: [
                            'rgba(249, 115, 22, 1)',
                            'rgba(96, 165, 250, 1)',
                            'rgba(52, 211, 153, 1)',
                            'rgba(251, 191, 36, 1)'
                        ],
                        borderWidth: 1.5
                    }]
                },
                options: chartOptions
            });


            new Chart(document.getElementById('severityChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Low', 'Medium', 'High'],
                    datasets: [{
                        data: [<?php echo $lowCount; ?>, <?php echo $medCount; ?>, <?php echo $highCount; ?>],
                        backgroundColor: [
                            'rgba(52, 211, 153, 0.75)',
                            'rgba(251, 191, 36, 0.75)',
                            'rgba(213, 33, 33, 0.75)'
                        ],
                        borderColor: [
                            'rgba(52, 211, 153, 1)',
                            'rgba(251, 191, 36, 1)',
                            'rgb(255, 0, 0)'
                        ],
                        borderWidth: 1.5
                    }]
                },
                options: chartOptions
            });


            new Chart(document.getElementById('statusChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Accepted', 'Rejected'],
                    datasets: [{
                        data: [<?php echo $pendingCount; ?>, <?php echo $acceptedCount; ?>, <?php echo $rejectedCount; ?>],
                        backgroundColor: [
                            'rgba(249, 115, 22, 0.75)',
                            'rgba(52, 211, 153, 0.75)',
                            'rgba(248, 60, 60, 0.75)'
                        ],
                        borderColor: [
                            'rgba(249, 115, 22, 1)',
                            'rgba(52, 211, 153, 1)',
                            'rgba(248, 113, 113, 1)'
                        ],
                        borderWidth: 1.5
                    }]
                },
                options: chartOptions
            });
        </script>

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
</div>

    <script src="script.js"></script>

</body>

</html>