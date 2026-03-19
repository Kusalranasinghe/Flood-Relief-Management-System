<?php
include 'database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: userlogin.php");
    exit;
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>User Dashboard</title>
</head>

<body>

    <header class="navbar" style="padding:20px;padding-left:80px;padding-right:80px;">
        <div class="logo">#HelpSriLanka</div>
        <nav>
            <a href="index.php">Home</a>
            <button class="btn-login" style="width:auto;padding:8px 20px;" onclick="window.location.href='logout.php'">Logout</button>
        </nav>
    </header>

    <div class="dashboard-container">

        <div class="dashboard-header">
            <h2>Welcome, <?php echo $_SESSION['user_name']; ?> </h2>
            <p>Manage your flood relief requests below</p>
        </div>

        <?php
        $totalReq = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE user_id='$user_id'"))['c'];
        $pendingReq = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE user_id='$user_id' AND status='pending'"))['c'];
        $acceptedReq = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE user_id='$user_id' AND status='accepted'"))['c'];
        $rejectedReq = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE user_id='$user_id' AND status='rejected'"))['c'];
        ?>
        <div class="stats-grid-4" style="margin-bottom:30px;">
            <div class="stat-card">
                <h5>Total Requests</h5>
                <h2><?php echo $totalReq; ?></h2>
            </div>
            <div class="stat-card">
                <h5>Pending</h5>
                <h2 style="color:#eab308;"><?php echo $pendingReq; ?></h2>
            </div>
            <div class="stat-card">
                <h5>Accepted</h5>
                <h2 style="color:#22c55e;"><?php echo $acceptedReq; ?></h2>
            </div>
            <div class="stat-card">
                <h5>Rejected</h5>
                <h2 style="color:#ef4444;"><?php echo $rejectedReq; ?></h2>
            </div>
        </div>

        <div class="section-label"> My Relief Requests</div>
        <p style="font-size:12px;color:#94a3b8;margin-bottom:14px;margin-top:6px;padding-left:4px;">Click any row to view details, update or delete</p>
        <div class="dashboard-section">
            <table class="custom-table w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>District</th>
                        <th>Severity</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM requests WHERE user_id='$user_id' ORDER BY req_date DESC";
                    $result = mysqli_query($conn, $sql);
                    $rowNum = 1;

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if (strtolower($row['sev_level']) == 'high')
                                $sevStyle = 'style="color:#ef4444;font-weight:bold"';
                            elseif (strtolower($row['sev_level']) == 'medium')
                                $sevStyle = 'style="color:#eab308;font-weight:bold"';
                            else
                                $sevStyle = 'style="color:#22c55e;font-weight:bold"';

                            $statusColor = $row['status'] == 'accepted' ? '#22c55e' : ($row['status'] == 'rejected' ? '#ef4444' : '#eab308');
                            $statusIcon = $row['status'] == 'accepted' ? '✅' : ($row['status'] == 'rejected' ? '❌' : '');

                            $isPending = $row['status'] == 'pending' ? 'true' : 'false';

                            echo "<tr class='request-row' style='cursor:pointer;'
                                data-id='{$row['id']}'
                                data-type='" . ucfirst($row['type']) . "'
                                data-district='" . ucfirst($row['district']) . "'
                                data-severity='" . ucfirst($row['sev_level']) . "'
                                data-date='{$row['req_date']}'
                                data-status='" . ucfirst($row['status']) . "'
                                data-statuscolor='{$statusColor}'
                                data-pending='{$isPending}'>
                                <td style='color:#94a3b8;'>{$rowNum}</td>
                                <td><span style='background:rgba(249,115,22,0.12);padding:3px 10px;border-radius:20px;color:#fdba74;font-size:13px;'>" . ucfirst($row['type']) . "</span></td>
                                <td>" . ucfirst($row['district']) . "</td>
                                <td $sevStyle>" . ucfirst($row['sev_level']) . "</td>
                                <td style='color:#94a3b8;'>{$row['req_date']}</td>
                                <td style='color:{$statusColor};font-weight:bold;'>{$statusIcon} " . ucfirst($row['status']) . "</td>
                            </tr>";
                            $rowNum++;
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;color:#94a3b8;padding:30px;'>No requests found. Submit your first relief request below.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div style="text-align:center;margin-top:20px;">
                <a href="reilief.php" class="btn-login" style="width:auto;padding:10px 30px;display:inline-block;text-decoration:none;">+ New Relief Request</a>
            </div>

        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="script.js"></script>

    
    <div id="userRequestModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:9999;justify-content:center;align-items:center;">
        <div style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);border-radius:20px;padding:40px;width:480px;max-width:90%;box-shadow:0 0 40px rgba(0,0,0,0.5);position:relative;">

            <button onclick="closeUserModal()" style="position:absolute;top:15px;right:20px;background:transparent;border:none;color:#94a3b8;font-size:20px;cursor:pointer;">✕</button>

            <h3 style="color:#f97316;margin-bottom:20px;font-size:20px;">📋 Request Details</h3>

            <div id="userModalContent" style="display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:25px;"></div>

            <div id="userModalActions" style="display:flex;justify-content:space-between;align-items:center;gap:10px;"></div>

        </div>
    </div>

    <script>
        document.querySelectorAll('.request-row').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.background = 'rgba(249,115,22,0.05)';
            });
            row.addEventListener('mouseleave', function() {
                this.style.background = '';
            });
            row.addEventListener('click', function() {
                const d = this.dataset;
                document.getElementById('userModalContent').innerHTML = `
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Relief Type</div>
                    <div style="color:#fdba74;font-weight:600;">${d.type}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">District</div>
                    <div style="color:white;font-weight:600;">${d.district}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Severity</div>
                    <div style="font-weight:600;color:${d.severity.toLowerCase() === 'high' ? '#ef4444' : d.severity.toLowerCase() === 'medium' ? '#eab308' : '#22c55e'}">${d.severity}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Date</div>
                    <div style="color:white;">${d.date}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Status</div>
                    <div style="color:${d.statuscolor};font-weight:bold;">${d.status}</div>
                </div>
            `;

                
                if (d.pending === 'true') {
                    document.getElementById('userModalActions').innerHTML = `
                    <button onclick="closeUserModal()" style="background:transparent;border:1px solid rgba(255,255,255,0.15);color:rgba(255,255,255,0.6);padding:8px 18px;border-radius:8px;cursor:pointer;">Cancel</button>
                    <div style="display:flex;gap:10px;">
                        <a href="action.php?action=update&id=${d.id}" 
                            style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.4);color:#22c55e;padding:8px 18px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">
                            ✏️ Update
                        </a>
                        <a href="action.php?action=delete&id=${d.id}" 
                            onclick="return confirmAction('Delete this relief request? This cannot be undone.')"
                            style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.4);color:#ef4444;padding:8px 18px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">
                            🗑 Delete
                        </a>
                    </div>
                `;
                } else {
                    document.getElementById('userModalActions').innerHTML = `
                    <button onclick="closeUserModal()" style="background:transparent;border:1px solid rgba(255,255,255,0.15);color:rgba(255,255,255,0.6);padding:8px 18px;border-radius:8px;cursor:pointer;">Close</button>
                    <span style="color:#475569;font-size:13px;">This request has been ${d.status.toLowerCase()} — no changes allowed.</span>
                `;
                }

                document.getElementById('userRequestModal').style.display = 'flex';
            });
        });

        function closeUserModal() {
            document.getElementById('userRequestModal').style.display = 'none';
        }

        document.getElementById('userRequestModal').addEventListener('click', function(e) {
            if (e.target === this) closeUserModal();
        });
    </script>

</body>

</html>