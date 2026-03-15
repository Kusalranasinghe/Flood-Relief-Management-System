<?php
include 'database.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit;
}
$isStandalone = !defined('INCLUDED');
?>

<?php if ($isStandalone): ?>
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

            <div class="dashboard-header">
                <h2>Registered Volunteers</h2>
                <p>Overview of all registered flood relief volunteers</p>
            </div>


            <div class="section-label"> Volunteer Summary by Type</div>
            <div class="stats-grid-4" style="margin-bottom:30px;">
                <div class="stat-card">
                    <h5>Total Volunteers</h5>
                    <?php
                    $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM volunteers");
                    $data = mysqli_fetch_assoc($res);
                    echo "<h2>" . $data['total'] . "</h2>";
                    ?>
                </div>
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

            <div class="section-label"> Volunteer List</div>
            
            <div class="dashboard-section">
                <div class="mb-3">
                    <input type="text" id="volunteerSearch" class="form-control"
                        placeholder="🔍 Search by name, NIC or type..."
                        style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;padding:10px 16px;">
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
                            echo "<td>" . $row['v_id']. "</td>";
                            echo "<td>" . $row['type'] . "</td>";
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
            <script>
                document.getElementById('volunteerSearch').addEventListener('keyup', function() {
                    const filter = this.value.toLowerCase();
                    document.querySelectorAll('#historyTable tbody tr').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
                    });
                });

                document.querySelectorAll('#historyTable tbody tr').forEach(row => {
                    row.addEventListener('mouseenter', function() {
                        this.style.background = 'rgba(249,115,22,0.05)';
                    });
                    row.addEventListener('mouseleave', function() {
                        this.style.background = '';
                    });
                });
            </script>
    </body>

    </html>
<?php endif; ?>