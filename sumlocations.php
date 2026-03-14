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

$totalPending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending'"))['c'];
$totalHighSev = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending' AND LOWER(sev_level)='high'"))['c'];
$totalDistricts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT district) AS c FROM requests WHERE status='pending'"))['c'];
$generatedDate = date('F d, Y — h:i A');

if ($isStandalone):
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
        <title>District Summary Report — #HelpSriLanka</title>
    </head>

    <body>
        <?php include 'admin_topbar.php'; ?>
        <div class="dashboard-container report-page">

            <div class="report-header-block">
                <div class="report-header-left">
                    <div class="report-org-name">#HelpSriLanka — Flood Relief Management System</div>
                    <h1 class="report-title"> District-wise Pending Request Summary</h1>
                    <p class="report-subtitle">Active flood relief requests grouped by administrative district</p>
                </div>
                <div class="report-header-right no-print">
                    <div class="report-generated">
                        <span style="color:#94a3b8;font-size:12px;">Report Generated</span><br>
                        <span style="color:#f97316;font-size:13px;font-weight:600;"><?php echo $generatedDate; ?></span>
                    </div>
                </div>
            </div>

            <!--Summary Cards-->
            <div class="report-meta-grid">
                <div class="report-meta-card">
                    <span class="report-meta-label">Total Pending Requests</span>
                    <span class="report-meta-value"><?php echo $totalPending; ?></span>
                </div>
                <div class="report-meta-card urgent">
                    <span class="report-meta-label"> High Severity</span>
                    <span class="report-meta-value" style="color:#ef4444;"><?php echo $totalHighSev; ?></span>
                </div>
                <div class="report-meta-card">
                    <span class="report-meta-label">Affected Districts</span>
                    <span class="report-meta-value"><?php echo $totalDistricts; ?></span>
                </div>
                <div class="report-meta-card">
                    <span class="report-meta-label">Report Status</span>
                    <span class="report-meta-value" style="color:#22c55e;font-size:14px;">● Live Data</span>
                </div>
            </div>

            <!-- Search -->
            <div class="mb-3 no-print">
                <input type="text" id="districtSearch" class="form-control"
                    placeholder="🔍 Search by district..."
                    style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;padding:10px 16px;">
            </div>

        <?php endif; ?>

        <!-- Table -->
        <table class="custom-table w-100" id="locationTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>District</th>
                    <th>Total Pending</th>
                    <th>High Severity</th>
                    <th>Most Needed Relief</th>
                    <th>Affected Families</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $limit = defined('ROW_LIMIT') ? ROW_LIMIT : 99999;
                $result = mysqli_query($conn, "
                SELECT 
                    district,
                    COUNT(*) AS total,
                    SUM(CASE WHEN LOWER(sev_level) = 'high' THEN 1 ELSE 0 END) AS high_sev,
                    SUM(no_of_fmembers) AS total_families
                FROM requests
                WHERE status = 'pending'
                GROUP BY district 
                ORDER BY total DESC
                LIMIT $limit
            ");

                $rowNum = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $dist = mysqli_real_escape_string($conn, $row['district']);
                        $typeRes = mysqli_query($conn, "
                        SELECT type, COUNT(*) AS cnt 
                        FROM requests 
                        WHERE district = '$dist' AND status = 'pending'
                        GROUP BY type ORDER BY cnt DESC LIMIT 1
                    ");
                        $typeRow = mysqli_fetch_assoc($typeRes);
                        $mostNeeded = $typeRow ? ucfirst($typeRow['type']) : 'N/A';
                        $highColor = $row['high_sev'] > 0 ? 'style="color:#ef4444;font-weight:bold"' : 'style="color:#22c55e"';

                        echo "<tr>
                        <td style='color:#94a3b8;'>{$rowNum}</td>
                        <td><strong>" . ucfirst($row['district']) . "</strong></td>
                        <td>{$row['total']}</td>
                        <td $highColor>{$row['high_sev']}</td>
                        <td><span style='background:rgba(249,115,22,0.15);padding:3px 10px;border-radius:20px;color:#fdba74'>{$mostNeeded}</span></td>
                        <td>{$row['total_families']}</td>
                    </tr>";
                        $rowNum++;
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;color:#94a3b8;padding:30px;'>No pending requests found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <?php if ($isStandalone): ?>

            <div class="report-footer">
                <span>Generated by #HelpSriLanka Flood Relief Management System</span>
                <span><?php echo $generatedDate; ?></span>
            </div>

            <script>
                document.getElementById('districtSearch').addEventListener('keyup', function() {
                    const filter = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#locationTable tbody tr');
                    rows.forEach(row => {
                        const district = row.cells[1].textContent.toLowerCase();
                        row.style.display = district.includes(filter) ? '' : 'none';
                    });
                });
            </script>

        </div>
    </body>

    </html>
<?php endif; ?>