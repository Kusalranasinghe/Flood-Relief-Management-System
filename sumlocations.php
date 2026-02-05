<?php

include 'database.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>View Locations</title>
</head>

<body>

    <h1>View All Locations</h1>

    <table class="table table-bordered table-striped table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th>District</th>
                <th>Percentage</th>
                <th>View</th>
            </tr>
        </thead>

        <tbody>

            <?php

            $totalQuery = "SELECT COUNT(*) AS total FROM requests";
            $totalResult = mysqli_query($conn, $totalQuery);
            $totalRow = mysqli_fetch_assoc($totalResult);
            $totalRequests = $totalRow['total'];

            $sql = "SELECT district, COUNT(*) AS district_count 
        FROM requests 
        GROUP BY district";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {


                    $percentage = ($row['district_count'] / $totalRequests) * 100;
                    $percentage = round($percentage, 2);

                    echo "<tr>
                <td>{$row['district']}</td>
                <td>{$percentage}%</td>
                <td>
                    <a href='relieflocation.php?district={$row['district']}' 
                       class='btn btn-success'>See</a>
                </td>
              </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No records found</td></tr>";
            }
            ?>

        </tbody>
    </table>


</body>

</html>

<?php



?>