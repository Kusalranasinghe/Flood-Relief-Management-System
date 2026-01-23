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

    <table class="table table-bordered table-striped table-hover text-center">
        <thead class="table-dark">

            <tr>
                <th>Request ID</th>
                <th>Severity Level</th>
                <th>Request Type</th>
                <th>District</th>
                <th>Contact Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php

            $sql = "SELECT * FROM requests";
            $result = mysqli_query($conn, $sql);

            ?>

            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['sev_level']}</td>
                        <td>{$row['type']}</td>
                        <td>{$row['district']}</td>
                        <td>{$row['telephone']}</td>
                        <td>
                    <a href='action.php?action=accept&id={$row['id']}' class='btn btn-success'>Accept</a>
                    <a href='action.php?action=reject&id={$row['id']}' class='btn btn-danger'>Reject</a>
                </td>
                      
                      </tr>";
                }

            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
            ?>

        </tbody>
    </table>

</body>

</html>