<?php

include 'database.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Admin Dashboard</title>
</head>

<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome to the admin dashboard. Here you can manage flood relief requests and view statistics.</p>

    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Registered Users</h5>

                    <?php

                    $sql = "SELECT COUNT(*) AS total_users FROM users";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    ?>

                    <h1 id="reg_users"><?php echo $row['total_users']; ?></h1>

                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">High Severity Households</h5>

                    <?php

                    $sql = "SELECT COUNT(*) AS house_request FROM requests WHERE type = 'shelter' AND status = 'pending'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    ?>

                    <h1 id="house_req"><?php echo $row['house_request']; ?></h1>

                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Water Requests</h5>

                    <?php

                    $sql = "SELECT COUNT(*) AS water_request FROM requests WHERE type = 'water' AND status = 'pending'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    ?>

                    <h1 id="water_req"><?php echo $row['water_request']; ?></h1>


                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Food Requests</h5>

                    <?php

                    $sql = "SELECT COUNT(*) AS food_request FROM requests WHERE type = 'food' AND status = 'pending'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    ?>

                    <h1 id="food_req"><?php echo $row['food_request']; ?></h1>

                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Medicine Requests</h5>

                    <?php

                    $sql = "SELECT COUNT(*) AS med_request FROM requests WHERE type = 'medicine' AND status = 'pending'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    ?>

                    <h1 id="med_req"><?php echo $row['med_request']; ?></h1>

                </div>
            </div>
        </div>
    </div>

    <button><a href="requestdashboard.php">View Requests</a></button>
    <button><a href="viewusers.php">View All Users</a></button>
    <button><a href="sumlocations.php">View All Locations</a></button>
    <button><a href="reliefhistory.php">View Relief History</a></button>


    <a href="logout.php" class="btn btn-danger">Logout</a>


</body>

</html>