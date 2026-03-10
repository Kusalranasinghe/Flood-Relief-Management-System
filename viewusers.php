<?php

include 'database.php';

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
    <div class="container mt-5">
        <div class="dashboard-header mb-4">
            <h2>Registered System Users</h2>
            <p>Manage and view detailed profiles of affected persons</p>
        </div>

        <div class="table-card">
            <table class="custom-table w-100">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM users");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>
                                <a href='userdetail.php?id={$row['id']}' class='btn btn-sm btn-info'>View Profile</a>
                                <a href='action.php?action=delete_user&id={$row['id']}' onclick='return confirm(\"Delete user?\")' class='btn btn-sm btn-danger'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <a href="admindashboard.php" class="btn btn-outline-light">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>