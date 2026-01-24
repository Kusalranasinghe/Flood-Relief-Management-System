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

    <h3>Welcome <?php echo $_SESSION['user_name']; ?></h3>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Request ID</th>
                <th>Request Type</th>
                <th>Flood Severity Level</th>
                <th>Request Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php

            $sql = "SELECT * FROM requests WHERE user_id='$user_id'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['type']}</td>";
                    echo "<td>{$row['sev_level']}</td>";
                    echo "<td>{$row['req_date']}</td>";
                    echo "<td>
                    <a href='action.php?action=update&id={$row['id']}' class='btn btn-success'>Update</a>
                    <a href='action.php?action=delete&id={$row['id']}' class='btn btn-danger'>Delete</a>
                </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No requests found</td></tr>";
            }
            ?>
        </tbody>
    </table>


    <button><a href="reilief.php">Relief Request</a></button>



</body>

</html>