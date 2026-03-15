<?php
include 'database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: userlogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <div class="request-container">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="request-card">

            <h2>Flood Relief Request</h2>
            <title>Relief Request</title>
            <input type="hidden" name="u_id" value="<?php echo $_SESSION['user_id']; ?>">
            <div class="mb-3">
                <label>Type of Relief</label>
                <select name="type" class="form-control">
                    <option value="food">Food</option>
                    <option value="water">Water</option>
                    <option value="medicine">Medicine</option>
                    <option value="shelter">Shelter</option>
                </select>
            </div>

            <div class="mb-3">
                <label>District</label>
                <select id="district_select" name="district" class="form-control" onchange="fetchDivisions(this.value)" required>
                    <option value="">Select District</option>
                    <?php
                    $distRes = mysqli_query($conn, "SELECT name FROM districts ORDER BY name ASC");
                    while ($distRow = mysqli_fetch_assoc($distRes)) {
                        echo "<option value='{$distRow['name']}'>{$distRow['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Divisional Secretariat Division</label>
                <select id="ds_select" name="ds_div" class="form-control" required>
                    <option value="">Select District First</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Grama Niladari Division</label>
                <input type="text" name="gn_div" class="form-control" placeholder="Enter your GN Division">
            </div>

            <div class="mb-3">
                <label>Person's Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter contact person's full name">
            </div>

            <div class="mb-3">
                <label>Telephone</label>
                <input type="text" name="telephone" id="phone_input" class="form-control" placeholder="e.g. 0778767787">
                <small id="phone_error" style="color:#ff4d4d;display:none;">Please enter exactly 9 digits.</small>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter your full address">
            </div>

            <div class="mb-3">
                <label>Number of Family Members</label>
                <input type="number" name="no_of_members" id="members_input" class="form-control" min="1" placeholder="Enter number of family members">
                <small id="members_error" style="color:#ff4d4d;display:none;">Must be a positive number (greater than 0).</small>
            </div>

            <div class="mb-3">
                <label>Flood Severity Level</label>
                <select name="sev_level" class="form-control">
                    <option value="low">🟡 Low — Below knee level</option>
                    <option value="medium">🟠 Medium — Knee to chest level</option>
                    <option value="high">🔴 High — Above chest level</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" placeholder="Mention any additional or special requirements here..."></textarea>
            </div>

            <button type="submit" class="btn-request">Send Request</button>
            <div style="text-align:center;margin-top:20px;padding-top:16px;border-top:1px solid rgba(255,255,255,0.06);">
                <a href="userdashboard.php" class="faded-back-link">← Back to Dashboard</a>
            </div>
        </form>

    </div>
    <script src="script.js"></script>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $u_id = $_POST['u_id'];
    $type = $_POST['type'];
    $district = $_POST['district'];
    $ds_div = $_POST['ds_div'];
    $gn_div = $_POST['gn_div'];
    $name = $_POST['name'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $no_of_members = $_POST['no_of_members'];
    $sev_level = $_POST['sev_level'];
    $description = $_POST['description'];

    if (empty($type) || empty($district) || empty($ds_div) || empty($gn_div) || empty($name) || empty($telephone) || empty($address) || empty($no_of_members) || empty($sev_level)) {
        echo "<script>alert('Please fill in all required fields.');</script>";
        exit;
    }
    if (!is_numeric($telephone) || !is_numeric($no_of_members)) {
        echo "<script>alert('Telephone and Number of family members must be numeric.');</script>";
        exit;
    }

    if ($no_of_members <= 0) {
        echo "<script>alert('Number of family members must be a positive number.');</script>";
        exit;
    } else {
        $sql = "INSERT INTO requests (user_id, type, district, ds_div, gn_div, name, telephone, address, no_of_fmembers, sev_level, description, status) VALUES ('$u_id', '$type', '$district', '$ds_div', '$gn_div', '$name', '$telephone', '$address', '$no_of_members', '$sev_level', '$description', 'pending')";

        mysqli_query($conn, $sql);
        echo "<script>
    alert('Your relief request has been submitted successfully.');
    window.location.href='userdashboard.php';
</script>";

        mysqli_close($conn);
    }
}

?>