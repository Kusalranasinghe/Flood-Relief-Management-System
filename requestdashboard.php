<?php

include 'database.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="dashboard-header mb-4">
            <h2>Relief Request Management</h2>
            <p>Review and take action on pending flood relief requests</p>
        </div>

        <div class="table-card">
            <div class="mb-3">
                <input type="text" id="requestSearch" class="form-control"
                    placeholder="🔍 Search by district or type..."
                    style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;padding:10px 16px;">
            </div>
            <table class="custom-table w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Severity</th>
                        <th>District</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM requests WHERE status='pending'");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sevColor = ($row['sev_level'] == 'High') ? 'text-danger' : 'text-warning';
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>" . ucfirst($row['type']) . "</td>
                                <td class='$sevColor'><strong>{$row['sev_level']}</strong></td>
                                <td>{$row['district']}</td>
                                <td>
                                    <a href='action.php?action=accept&id={$row['id']}' onclick='return confirm(\"Approve this?\")' class='btn btn-sm btn-success'>Accept</a>
                                    <a href='action.php?action=reject&id={$row['id']}' onclick='return confirm(\"Reject this?\")' class='btn btn-sm btn-danger'>Reject</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No pending requests found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <a href="admindashboard.php" class="btn-update" style="border-radius:25px;">← Back to Dashboard</a>
        </div>
    </div>
    <script>
        document.getElementById('requestSearch').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>

</html>