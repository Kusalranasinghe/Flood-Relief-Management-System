<?php
include 'database.php';
session_start();
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

    <div class="dashboard-container" style="padding-bottom: 60px;">

        <div class="dashboard-header">
            <h2>Welcome <?php echo $_SESSION['user_name']; ?></h2>
            <p>User ID : <?php echo $_SESSION['user_id']; ?></p>
        </div>

        <div class="table-card">

            <table class="custom-table">

                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Request Type</th>
                        <th>Flood Severity</th>
                        <th>Request Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    $sql = "SELECT * FROM requests WHERE user_id='$user_id' AND status='pending'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['type']}</td>";
                            echo "<td>{$row['sev_level']}</td>";
                            echo "<td>{$row['req_date']}</td>";

                            echo "<td>
                        <a href='action.php?action=update&id={$row['id']}' class='btn-update'>Update</a>
                        <a href='action.php?action=delete&id={$row['id']}' class='btn-delete'>Delete</a>
                        </td>";

                            echo "</tr>";
                        }

                    } else {

                        echo "<tr><td colspan='5'>No requests found</td></tr>";

                    }

                    ?>

                </tbody>

            </table>

        </div>

        <div class="dashboard-buttons">

            <a href="reilief.php" class="btn-frequest">New Relief Request</a>

            <a href="logout.php" class="btn-logout">Logout</a>

        </div>

    </div>

</body>

</html>