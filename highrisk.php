<?php
include 'database.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High Severity Requests</title>

    <link rel="stylesheet" href="styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <?php include 'admin_topbar.php'; ?>

    <div class="dashboard-container">

        <div class="dashboard-header">
            <h2 style="color: red;">High Severity Relief Requests</h2>
            <p>Pending emergency requests</p>
        </div>

        <?php
        $highPending = mysqli_fetch_assoc(
            mysqli_query($conn, "SELECT COUNT(*) AS c 
FROM requests 
WHERE status='pending' AND LOWER(sev_level)='high'")
        )['c'];
        ?>

       

        <div class="dashboard-section">

            <table class="custom-table w-100">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>District</th>
                        <th>Contact Person</th>
                        <th>Families</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $result = mysqli_query($conn, "
SELECT * FROM requests
WHERE status='pending'
AND LOWER(sev_level)='high'
ORDER BY req_date ASC
");

                    $rowNum = 1;

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "

<tr>

<td>{$rowNum}</td>

<td>
<span style='background:rgba(249,115,22,0.12);
padding:3px 10px;
border-radius:20px;
color:#fdba74;
font-size:13px;'>
" . ucfirst($row['type']) . "
</span>
</td>

<td><strong>" . ucfirst($row['district']) . "</strong></td>

<td>{$row['name']}</td>

<td>{$row['no_of_fmembers']}</td>

<td>{$row['req_date']}</td>

</tr>

";

                            $rowNum++;

                        }

                    } else {

                        echo "<tr>
<td colspan='6' style='text-align:center;padding:30px;'>
No High Severity Requests Found
</td>
</tr>";

                    }

                    ?>

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>