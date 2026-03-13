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

    $update_sql = "UPDATE requests SET type='$type', sev_level='$sev_level' WHERE id='$request_id' AND user_id='$user_id'";

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Request</title>
</head>
<body>

    <header class="navbar">
        <div class="logo">#HelpSriLanka </div>
        <nav>
            <a href="userdashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="form">
        <div class="login-container">
            <form method="POST" class="login-card">
                <div style="text-align: center;">
                    <div class="badge" style="margin-bottom: 10px; display: inline-block;">Request ID: #<?php echo $request_id; ?></div>
                    <h2>Edit Relief Request</h2>
                </div>

                <div class="mb-3">
                    <label>Request Type</label>
                    <select name="type" class="form-control custom-select">
                        <option value="food" <?= ($row['type'] == "food") ? "selected" : "" ?>>Food Aid</option>
                        <option value="water" <?= ($row['type'] == "water") ? "selected" : "" ?>>Clean Water</option>
                        <option value="medical" <?= ($row['type'] == "medical") ? "selected" : "" ?>>Medical Supplies</option>
                        <option value="shelter" <?= ($row['type'] == "shelter") ? "selected" : "" ?>>Emergency Shelter</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Severity Level</label>
                    <select name="sev_level" class="form-control custom-select">
                        <option value="Low" <?= ($row['sev_level'] == "Low") ? "selected" : "" ?>>Low</option>
                        <option value="Medium" <?= ($row['sev_level'] == "Medium") ? "selected" : "" ?>>Medium</option>
                        <option value="High" <?= ($row['sev_level'] == "High") ? "selected" : "" ?>>High</option>
                    </select>
                </div>

                <button type="submit" name="update" class="btn-login">Update Request</button>
                
                <div class="text-center mt-3">
                    <a href="userdashboard.php" style="color: #94a3b8; text-decoration: none; font-size: 14px;">← Back to Dashboard</a>
                </div>
            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>
</html>