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

$totalAccepted = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='accepted'"))['c'];
$totalRejected = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='rejected'"))['c'];
$totalCompleted = $totalAccepted + $totalRejected;
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
        <title>Relief History Report — #HelpSriLanka</title>
    </head>

    <body>
        <?php include 'admin_topbar.php'; ?>
        <div class="dashboard-container report-page">
            <!-- Report Header -->
            <div class="report-header-block">
                <div class="report-header-left">
                    <div class="report-org-name">#HelpSriLanka — Flood Relief Management System</div>
                    <h1 class="report-title"> Completed Relief Request History</h1>
                    <p class="report-subtitle">All accepted and rejected flood relief requests with action details</p>
                </div>
                <div class="report-header-right no-print">
                    <div class="report-generated">
                        <span style="color:#94a3b8;font-size:12px;">Report Generated</span><br>
                        <span style="color:#f97316;font-size:13px;font-weight:600;"><?php echo $generatedDate; ?></span>
                    </div>
                </div>
            </div>

            <!-- Report Summary Cards -->
            <div class="report-meta-grid">
                <div class="report-meta-card">
                    <span class="report-meta-label">Total Completed</span>
                    <span class="report-meta-value"><?php echo $totalCompleted; ?></span>
                </div>
                <div class="report-meta-card">
                    <span class="report-meta-label">✅ Accepted</span>
                    <span class="report-meta-value" style="color:#22c55e;"><?php echo $totalAccepted; ?></span>
                </div>
                <div class="report-meta-card">
                    <span class="report-meta-label">❌ Rejected</span>
                    <span class="report-meta-value" style="color:#ef4444;"><?php echo $totalRejected; ?></span>
                </div>
                <div class="report-meta-card">
                    <span class="report-meta-label">Report Status</span>
                    <span class="report-meta-value" style="color:#22c55e;font-size:14px;">● Live Data</span>
                </div>
            </div>

            <!-- Search & Filter -->
            <div style="display:flex;gap:10px;margin-bottom:15px;flex-wrap:wrap;" class="no-print">
                <input type="text" id="historySearch" class="form-control"
                    placeholder="🔍 Search by district, type or name..."
                    style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;padding:10px 16px;flex:1;">
                <select id="statusFilter" class="form-control"
                    style="background:#1e293b;border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;padding:10px 16px;width:180px;">
                    <option value="">All Status</option>
                    <option value="accepted">✅ Accepted</option>
                    <option value="rejected">❌ Rejected</option>
                </select>
            </div>

        <?php endif; ?>

        <!-- Table -->
        <table class="custom-table w-100" id="historyTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>District</th>
                    <th>Contact Person</th>
                    <th>Severity</th>
                    <th>Request Date</th>
                    <th>Action</th>
                    <th>Action Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $limit = defined('ROW_LIMIT') ? ROW_LIMIT : 99999;
                $result = mysqli_query($conn, "
                SELECT * FROM requests 
                WHERE status = 'accepted' OR status = 'rejected' 
                ORDER BY act_date DESC
                LIMIT $limit
            ");

                $rowNum = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if (strtolower($row['sev_level']) == 'high')
                            $sevStyle = 'style="color:#ef4444;font-weight:bold"';
                        elseif (strtolower($row['sev_level']) == 'medium')
                            $sevStyle = 'style="color:#eab308;font-weight:bold"';
                        else
                            $sevStyle = 'style="color:#22c55e;font-weight:bold"';

                        $actionColor = $row['status'] == 'accepted' ? '#22c55e' : '#ef4444';
                        $actionIcon = $row['status'] == 'accepted' ? '✅' : '❌';
                        $actionLabel = $actionIcon . ' ' . ucfirst($row['status']);
                        $actionDate = $row['act_date'] ?: '—';

                        echo "<tr>
                        <td style='color:#94a3b8;'>{$rowNum}</td>
                        <td><span style='background:rgba(249,115,22,0.12);padding:3px 10px;border-radius:20px;color:#fdba74;font-size:13px;'>" . ucfirst($row['type']) . "</span></td>
                        <td><strong>" . ucfirst($row['district']) . "</strong></td>
                        <td>{$row['name']}</td>
                        <td $sevStyle>" . ucfirst($row['sev_level']) . "</td>
                        <td style='color:#94a3b8;'>{$row['req_date']}</td>
                        <td style='color:{$actionColor};font-weight:bold;'>{$actionLabel}</td>
                        <td style='color:#94a3b8;'>{$actionDate}</td>
                    </tr>";
                        $rowNum++;
                    }
                } else {
                    echo "<tr><td colspan='8' style='text-align:center;color:#94a3b8;padding:30px;'>No completed requests found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <?php if ($isStandalone): ?>

            <!-- Report Footer -->
            <div class="report-footer">
                <span>Generated by #HelpSriLanka Flood Relief Management System</span>
                <span><?php echo $generatedDate; ?></span>
            </div>

            <script>
                function filterHistory() {
                    const search = document.getElementById('historySearch').value.toLowerCase();
                    const status = document.getElementById('statusFilter').value.toLowerCase();
                    const rows = document.querySelectorAll('#historyTable tbody tr');
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        const matchSearch = text.includes(search);
                        const matchStatus = status === '' || text.includes(status);
                        row.style.display = (matchSearch && matchStatus) ? '' : 'none';
                    });
                }
                document.getElementById('historySearch').addEventListener('keyup', filterHistory);
                document.getElementById('statusFilter').addEventListener('change', filterHistory);
            </script>

        </div>
    </body>

    </html>
<?php endif; ?>