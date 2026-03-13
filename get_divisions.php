<?php
include 'database.php';

if(isset($_POST['district'])) {
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $query = "SELECT ds_name FROM ds_divisions WHERE district_name = '$district' ORDER BY ds_name ASC";
    $result = mysqli_query($conn, $query);

    echo '<option value="">Select Division</option>';
    while($row = mysqli_fetch_assoc($result)) {
        echo '<option value="'.$row['ds_name'].'">'.$row['ds_name'].'</option>';
    }
}
?>