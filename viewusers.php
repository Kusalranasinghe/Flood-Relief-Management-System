<?php
include 'database.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit;
}

$totalUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM users"))['c'];
$latestUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name, created_date FROM users ORDER BY created_date DESC LIMIT 1"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <?php include 'admin_topbar.php'; ?>

    <div class="dashboard-container">

        <div class="dashboard-header">
            <h2>Registered System Users</h2>
            <p>Manage and view detailed profiles of affected persons</p>
        </div>

        <div class="stats-grid-2" style="margin-bottom:30px;">
            <div class="stat-card">
                <h5>Total Registered Users</h5>
                <h2><?php echo $totalUsers; ?></h2>
            </div>
            <div class="stat-card">
                <h5>Districts Represented</h5>
                <?php
                $distCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT district) AS c FROM users WHERE district != ''"))['c'];
                ?>
                <h2><?php echo $distCount; ?></h2>
            </div>
        </div>

        <div class="section-label"> User List</div>
        <p style="font-size:14px;color:#94a3b8;margin-bottom:14px;margin-top:6px;padding-left:4px;">Click any row to view full details</p>
        <div class="dashboard-section">

            <div class="mb-3">
                <input type="text" id="userSearch" class="form-control"
                    placeholder="🔍 Search by name, NIC or district..."
                    style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;padding:10px 16px;">
            </div>

            <table class="custom-table w-100" id="userTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>NIC</th>
                        <th>District</th>
                        <th>Telephone</th>
                        <th>Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM users ORDER BY created_date DESC");
                    $rowNum = 1;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $email = !empty($row['email']) ? $row['email'] : '—';
                            $district = !empty($row['district']) ? ucfirst($row['district']) : '—';
                            echo "<tr class='user-row' style='cursor:pointer;'
                            data-id='{$row['id']}'
                            data-name='" . htmlspecialchars($row['name']) . "'
                            data-nic='{$row['nic']}'
                            data-email='" . htmlspecialchars($email) . "'
                            data-telephone='{$row['telephone']}'
                            data-address='" . htmlspecialchars($row['address']) . "'
                            data-district='{$district}'
                            data-date='{$row['created_date']}'>
                            <td style='color:#94a3b8;'>{$rowNum}</td>
                            <td><strong>{$row['name']}</strong></td>
                            <td style='color:#94a3b8;'>{$row['nic']}</td>
                            <td>{$district}</td>
                            <td style='color:#94a3b8;'>+94{$row['telephone']}</td>
                            <td style='color:#94a3b8;'>{$row['created_date']}</td>
                        </tr>";
                            $rowNum++;
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;color:#94a3b8;padding:30px;'>No users found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <div id="userModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:9999;justify-content:center;align-items:center;">
        <div style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);border-radius:20px;padding:40px;width:500px;max-width:90%;box-shadow:0 0 40px rgba(0,0,0,0.5);position:relative;">

        
            <button onclick="closeModal()" style="position:absolute;top:15px;right:20px;background:transparent;border:none;color:#94a3b8;font-size:20px;cursor:pointer;">✕</button>

            <h3 style="color:#f97316;margin-bottom:20px;font-size:20px;"> User Details</h3>

            <div id="modalContent" style="display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:30px;"></div>

            
            <div style="background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.3);border-radius:12px;padding:16px;margin-bottom:20px;">
                <p style="color:#fca5a5;font-size:13px;margin:0;font-weight:600;">⚠️ Warning: Deleting a user is permanent and cannot be undone. All associated data will be lost.</p>
            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;">
                <button onclick="closeModal()" class="btn-back-blue" style="cursor:pointer;border:none;">Cancel</button>
                <a id="deleteBtn" href="#"
                    onclick="return confirmAction('⚠️ This action is permanent. Are you sure you want to delete this user?')"
                    style="background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.4);color:#ef4444;padding:8px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">
                    🗑 Delete User
                </a>
            </div>

        </div>
    </div>

    <script src="script.js"></script>
    <script>
        
        document.getElementById('userSearch').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            document.querySelectorAll('#userTable tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
            });
        });

        
        document.querySelectorAll('.user-row').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.background = 'rgba(249,115,22,0.05)';
            });
            row.addEventListener('mouseleave', function() {
                this.style.background = '';
            });
            row.addEventListener('click', function() {
                const d = this.dataset;
                document.getElementById('modalContent').innerHTML = `
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Full Name</div>
                    <div style="color:white;font-weight:600;">${d.name}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">NIC</div>
                    <div style="color:white;">${d.nic}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">District</div>
                    <div style="color:white;">${d.district}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Telephone</div>
                    <div style="color:white;">+94${d.telephone}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Email</div>
                    <div style="color:white;">${d.email}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Address</div>
                    <div style="color:white;">${d.address}</div>
                </div>
                <div>
                    <div style="color:#94a3b8;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Registered</div>
                    <div style="color:white;">${d.date}</div>
                </div>
            `;
                document.getElementById('deleteBtn').href = `action.php?action=delete_user&id=${d.id}`;
                const modal = document.getElementById('userModal');
                modal.style.display = 'flex';
            });
        });

        function closeModal() {
            document.getElementById('userModal').style.display = 'none';
        }

        
        document.getElementById('userModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>

</body>

</html>