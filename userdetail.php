<?php

include 'database.php';





if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Details</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    
</head>

<body>

    <div class="container mt-5">
        <h3 class="mb-4">User Full Details</h3>

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td><?php echo $row['id']; ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo $row['name']; ?></td>
            </tr>
            <tr>
                <th>NIC</th>
                <td><?php echo $row['nic']; ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo $row['address']; ?></td>
            </tr>
            <tr>
                <th>Telephone</th>
                <td><?php echo $row['telephone']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $row['email']; ?></td>
            </tr>
        </table>

        <a href="viewusers.php" class="btn btn-secondary">Back</a>
    </div>

</body>

</html>