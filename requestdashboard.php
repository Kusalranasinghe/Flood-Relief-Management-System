<?php
include 'database.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Requests</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <?php include 'admin_topbar.php'; ?>

    <div class="dashboard-container">

        <div class="dashboard-header">
            <h2>Relief Request Management</h2>
            <p>Review and take action on pending flood relief requests</p>
        </div>

        <?php
        $totalPending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending'"))['c'];
        $highPending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending' AND LOWER(sev_level)='high'"))['c'];
        ?>
        <div class="stats-grid-2" style="margin-bottom:30px;">
            <div class="stat-card">
                <h5>Total Pending Requests</h5>
                <h2><?php echo $totalPending; ?></h2>
            </div>
            <div class="stat-card urgent" onclick="window.location.href='highrisk.php'" style="cursor:pointer;">
                <h5> High Severity Pending</h5>
                <h2><?php echo $highPending; ?></h2>
            </div>
        </div>

        <div class="section-label"> Request List</div>
        <p style="font-size:14px;color:#94a3b8;margin-bottom:14px;margin-top:6px;padding-left:4px;">Click any row to
            view full details</p>
        <div class="dashboard-section">

            <div style="display:flex;gap:10px;margin-bottom:15px;flex-wrap:wrap;" class="no-print">
                <input type="text" id="requestSearch" class="form-control"
                    placeholder="🔍 Search by district, type or name..."
                    style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;padding:10px 16px;flex:1;">
                <select id="statusFilter" class="form-control"
                    style="background:#1e293b;border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;padding:10px 16px;width:180px;">
                    <option value="">All Status</option>
                    <option value="food"> Food</option>
                    <option value="water"> Water</option>
                    <option value="medicine"> Medicine</option>
                    <option value="shelter"> Shelter</option>
                </select>
            </div>

            <table class="custom-table w-100" id="requestTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Severity</th>
                        <th>District</th>
                        <th>Contact Person</th>
                        <th>Families</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM requests WHERE status='pending' ORDER BY 
                    CASE WHEN LOWER(sev_level)='high' THEN 1 
                         WHEN LOWER(sev_level)='medium' THEN 2 
                         ELSE 3 END ASC, req_date ASC");

                    $rowNum = 1;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if (strtolower($row['sev_level']) == 'high')
                                $sevStyle = 'style="color:#ef4444;font-weight:bold"';
                            elseif (strtolower($row['sev_level']) == 'medium')
                                $sevStyle = 'style="color:#eab308;font-weight:bold"';
                            else
                                $sevStyle = 'style="color:#22c55e;font-weight:bold"';

                            echo "<tr class='request-row' style='cursor:pointer;'
                            data-id='{$row['id']}'
                            data-type='" . ucfirst($row['type']) . "'
                            data-severity='" . ucfirst($row['sev_level']) . "'
                            data-district='" . ucfirst($row['district']) . "'
                            data-ds='" . htmlspecialchars($row['ds_div']) . "'
                            data-gn='" . htmlspecialchars($row['gn_div']) . "'
                            data-name='" . htmlspecialchars($row['name']) . "'
                            data-telephone='{$row['telephone']}'
                            data-address='" . htmlspecialchars($row['address']) . "'
                            data-families='{$row['no_of_fmembers']}'
                            data-description='" . htmlspecialchars($row['description']) . "'
                            data-date='{$row['req_date']}'>
                            <td style='color:#94a3b8;'>{$rowNum}</td>
                            <td><span style='background:rgba(249,115,22,0.12);padding:3px 10px;border-radius:20px;color:#fdba74;font-size:13px;'>" . ucfirst($row['type']) . "</span></td>
                            <td $sevStyle>" . ucfirst($row['sev_level']) . "</td>
                            <td><strong>" . ucfirst($row['district']) . "</strong></td>
                            <td>{$row['name']}</td>
                            <td>{$row['no_of_fmembers']}</td>
                            <td style='color:#94a3b8;'>{$row['req_date']}</td>
                        </tr>";
                            $rowNum++;
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align:center;color:#94a3b8;padding:30px;'>✅ No pending requests found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- REQUEST DETAIL MODAL -->
    <div id="requestModal"
        style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:9999;justify-content:center;align-items:center;">
        <div
            style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);border-radius:20px;padding:40px;width:560px;max-width:90%;box-shadow:0 0 40px rgba(0,0,0,0.5);position:relative;max-height:90vh;overflow-y:auto;">

            <button onclick="closeRequestModal()"
                style="position:absolute;top:15px;right:20px;background:transparent;border:none;color:#94a3b8;font-size:20px;cursor:pointer;">✕</button>

            <h3 style="color:#f97316;margin-bottom:20px;font-size:20px;">📋 Request Details</h3>

            <div id="requestModalContent"
                style="display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:25px;"></div>

            <!-- Description -->
            <div style="margin-bottom:25px;">
                <div
                    style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px;">
                    Description / Special Requirements</div>
                <div id="requestDescription"
                    style="color:white;background:rgba(255,255,255,0.05);padding:12px;border-radius:8px;font-size:14px;line-height:1.6;">
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;">
                <button onclick="closeRequestModal()" class="btn-back-blue"
                    style="cursor:pointer;border:none;">Cancel</button>
                <div style="display:flex;gap:10px;">
                    <a id="rejectBtn" href="#" onclick="return confirmAction('Reject this relief request?')"
                        style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.4);color:#ef4444;padding:8px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">
                        ✕ Reject
                    </a>
                    <a id="acceptBtn" href="#" onclick="return confirmAction('Accept this relief request?')"
                        style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.4);color:#22c55e;padding:8px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">
                        ✓ Accept
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script src="script.js"></script>
    <script>
        document.getElementById('requestSearch').addEventListener('keyup', function () {
            const filter = this.value.toLowerCase();
            document.querySelectorAll('#requestTable tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
            });
        });

        document.querySelectorAll('.request-row').forEach(row => {
            row.addEventListener('mouseenter', function () {
                this.style.background = 'rgba(249,115,22,0.05)';
            });
            row.addEventListener('mouseleave', function () {
                this.style.background = '';
            });
            row.addEventListener('click', function () {
                const d = this.dataset;
                document.getElementById('requestModalContent').innerHTML = `
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Relief Type</div>
                    <div style="color:#fdba74;font-weight:600;">${d.type}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Severity</div>
                    <div style="font-weight:600;color:${d.severity.toLowerCase() === 'high' ? '#ef4444' : d.severity.toLowerCase() === 'medium' ? '#eab308' : '#22c55e'}">${d.severity}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">District</div>
                    <div style="color:white;font-weight:600;">${d.district}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">DS Division</div>
                    <div style="color:white;">${d.ds}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">GN Division</div>
                    <div style="color:white;">${d.gn}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Contact Person</div>
                    <div style="color:white;">${d.name}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Telephone</div>
                    <div style="color:white;">+94${d.telephone}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Address</div>
                    <div style="color:white;">${d.address}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Family Members</div>
                    <div style="color:white;">${d.families}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Request Date</div>
                    <div style="color:white;">${d.date}</div>
                </div>
            `;
                document.getElementById('requestDescription').textContent = d.description || 'No additional requirements mentioned.';
                document.getElementById('acceptBtn').href = `action.php?action=accept&id=${d.id}`;
                document.getElementById('rejectBtn').href = `action.php?action=reject&id=${d.id}`;
                const modal = document.getElementById('requestModal');
                modal.style.display = 'flex';
            });
        });

        function closeRequestModal() {
            document.getElementById('requestModal').style.display = 'none';
        }

        document.getElementById('requestModal').addEventListener('click', function (e) {
            if (e.target === this) closeRequestModal();
        });

        function filterRequests() {
            const search = document.getElementById('requestSearch').value.toLowerCase();
            const type = document.getElementById('statusFilter').value.toLowerCase();
            const rows = document.querySelectorAll('#requestTable tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const typeCell = row.children[1].textContent.toLowerCase();

                const matchSearch = text.includes(search);
                const matchType = type === "" || typeCell.includes(type);

                row.style.display = (matchSearch && matchType) ? '' : 'none';
            });
        }

        document.getElementById('requestSearch').addEventListener('keyup', filterRequests);
        document.getElementById('statusFilter').addEventListener('change', filterRequests);

    </script>

</body>

</html>