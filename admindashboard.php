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
                <h1 id="reg_users">00</h1>
                
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">High Severity Households</h5>
                <h1 id="high_sev">00</h1>
            
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Food Requests</h5>
                <h1 id="food_req">00</h1>
                
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Medicine Requests</h5>
                <h1 id="med_req">00</h1>
                
            </div>
        </div>
    </div>
</div>

</body>

</html>