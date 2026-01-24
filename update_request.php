<?php
session_start();
include 'database.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: userlogin.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: userdashboard.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$request_id = $_GET['id'];

$sql = "SELECT * FROM requests WHERE id='$request_id' AND user_id='$user_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 1) {
    echo "Unauthorized access!";
    exit;
}

$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $type = $_POST['type'];
    $sev_level = $_POST['sev_level'];

    $update_sql = "UPDATE requests 
                   SET type='$type', sev_level='$sev_level'
                   WHERE id='$request_id' AND user_id='$user_id'";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: userdashboard.php");
        exit;
    } else {
        echo "Update failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Request</title>
</head>

<body>

    <form method="POST">

        <div class="mb-3">
            <label>Request Type</label>
            <select name="type">
                <option value="food" <?= ($row['type'] == "food") ? "selected" : "" ?>>Food</option>
                <option value="water" <?= ($row['type'] == "water") ? "selected" : "" ?>>Water</option>
                <option value="medical" <?= ($row['type'] == "medical") ? "selected" : "" ?>>Medical</option>
                <option value="shelter" <?= ($row['type'] == "shelter") ? "selected" : "" ?>>Shelter</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Severity Level</label>
            <select name="sev_level">
                <option value="Low" <?= ($row['sev_level'] == "Low") ? "selected" : "" ?>>Low</option>
                <option value="Medium" <?= ($row['sev_level'] == "Medium") ? "selected" : "" ?>>Medium</option>
                <option value="High" <?= ($row['sev_level'] == "High") ? "selected" : "" ?>>High</option>
            </select>
        </div>

        <button type="submit" name="update">
            Update Request
        </button>

    </form>

</body>

</html>