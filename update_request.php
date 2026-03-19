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
$request_id = intval($_GET['id']);

$sql = "SELECT * FROM requests WHERE id='$request_id' AND user_id='$user_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 1) {
    header("Location: userdashboard.php");
    exit;
}

$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
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

    if (empty($type) || empty($district) || empty($name) || empty($telephone) || empty($address) || empty($no_of_members) || empty($sev_level)) {
        $update_error = "Please fill in all required fields.";
    } else {
        $update_sql = "UPDATE requests SET 
            type='$type', district='$district', ds_div='$ds_div', 
            gn_div='$gn_div', name='$name', telephone='$telephone', 
            address='$address', no_of_fmembers='$no_of_members', 
            sev_level='$sev_level', description='$description' 
            WHERE id='$request_id' AND user_id='$user_id'";

        if (mysqli_query($conn, $update_sql)) {
            echo "<script>
                alert('Your relief request has been updated successfully.');
                window.location.href='userdashboard.php';
            </script>";
            exit;
        } else {
            $update_error = "Update failed. Please try again.";
        }
    }
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
    <title>Update Request</title>
</head>

<body>

    <header class="navbar" style="padding:20px;padding-left:80px;padding-right:80px;">
        <div class="logo">#HelpSriLanka</div>
        <nav>
            <a href="userdashboard.php">Dashboard</a>
            <button class="btn-login" style="width:auto;padding:8px 20px;" onclick="window.location.href='logout.php'">Logout</button>
        </nav>
    </header>

    <div class="request-container" style="padding-top:120px;">
        <form method="POST" class="request-card">

            <h2>Update Relief Request</h2>
            <p style="color:#94a3b8;font-size:13px;text-align:center;margin-bottom:20px;">Update your request details below</p>

            <?php if (isset($update_error)): ?>
                <div style="color:#ff4d4d;font-size:13px;margin-bottom:12px;text-align:center;"><?php echo $update_error; ?></div>
            <?php endif; ?>

            <div class="mb-3">
                <label>Type of Relief</label>
                <select name="type" class="form-control">
                    <option value="food" <?= ($row['type'] == 'food') ? 'selected' : '' ?>>Food</option>
                    <option value="water" <?= ($row['type'] == 'water') ? 'selected' : '' ?>>Water</option>
                    <option value="medicine" <?= ($row['type'] == 'medicine' || $row['type'] == 'medical') ? 'selected' : '' ?>>Medicine</option>
                    <option value="shelter" <?= ($row['type'] == 'shelter') ? 'selected' : '' ?>>Shelter</option>
                </select>
            </div>

            <div class="mb-3">
                <label>District</label>
                <select id="update_district" name="district" class="form-control" onchange="fetchDivisions(this.value)">
                    <option value="">Select District</option>
                    <?php
                    $distRes = mysqli_query($conn, "SELECT name FROM districts ORDER BY name ASC");
                    while ($distRow = mysqli_fetch_assoc($distRes)) {
                        $selected = ($row['district'] == $distRow['name']) ? 'selected' : '';
                        echo "<option value='{$distRow['name']}' {$selected}>{$distRow['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Divisional Secretariat Division</label>
                <select id="ds_select" name="ds_div" class="form-control" required>
                    <option value="<?php echo htmlspecialchars($row['ds_div']); ?>"><?php echo htmlspecialchars($row['ds_div']); ?></option>
                </select>
            </div>

            <div class="mb-3">
                <label>Grama Niladhari Division</label>
                <input type="text" name="gn_div" class="form-control" value="<?php echo htmlspecialchars($row['gn_div']); ?>" placeholder="Enter GN Division">
            </div>

            <div class="mb-3">
                <label>Contact Person's Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" placeholder="Enter contact person's full name">
            </div>

            <div class="mb-3">
                <label>Telephone</label>
                <div style="position:relative;">
                    <div class="input-group">
                        <span class="input-group-text" style="background:rgba(255,255,255,0.08);border:none;color:white;">+94</span>
                        <input type="text" name="telephone" id="update_phone" class="form-control"
                            value="<?php echo htmlspecialchars($row['telephone']); ?>"
                            placeholder="7XXXXXXXX" maxlength="9">
                    </div>
                    <span id="update_phone_tick" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#22c55e;font-size:16px;display:none;">✓</span>
                </div>
                <small id="update_phone_error" style="color:#ff4d4d;display:none;"></small>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($row['address']); ?>" placeholder="Enter your full address">
            </div>

            <div class="mb-3">
                <label>Number of Family Members</label>
                <input type="number" name="no_of_members" id="update_members" class="form-control" min="1" value="<?php echo $row['no_of_fmembers']; ?>">
                <small id="update_members_error" style="color:#ff4d4d;display:none;"> Must be a positive number.</small>
            </div>

            <div class="mb-3">
                <label>Flood Severity Level</label>
                <select name="sev_level" class="form-control">
                    <option value="low" <?= (strtolower($row['sev_level']) == 'low') ? 'selected' : '' ?>>🟡 Low — Below knee level</option>
                    <option value="medium" <?= (strtolower($row['sev_level']) == 'medium') ? 'selected' : '' ?>>🟠 Medium — Knee to chest level</option>
                    <option value="high" <?= (strtolower($row['sev_level']) == 'high') ? 'selected' : '' ?>>🔴 High — Above chest level</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Description <span style="color:#94a3b8;font-size:12px;">(optional)</span></label>
                <textarea name="description" class="form-control" placeholder="Mention any additional or special requirements here..."><?php echo htmlspecialchars($row['description']); ?></textarea>
            </div>

            <button type="submit" name="update" class="btn-request">Update Request</button>

            <div style="text-align:center;margin-top:20px;padding-top:16px;border-top:1px solid rgba(255,255,255,0.06);">
                <a href="userdashboard.php" class="faded-back-link">← Back to Dashboard</a>
            </div>

        </form>
    </div>

    <?php include 'footer.php'; ?>
    <script src="script.js"></script>

    <script>
        
        window.addEventListener('load', function() {
            const district = document.getElementById('update_district').value;
            if (district) {
                const currentDs = "<?php echo htmlspecialchars($row['ds_div']); ?>";
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "get_divisions.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById('ds_select').innerHTML = xhr.responseText;
                        
                        const options = document.getElementById('ds_select').options;
                        for (let i = 0; i < options.length; i++) {
                            if (options[i].value === currentDs) {
                                options[i].selected = true;
                                break;
                            }
                        }
                    }
                };
                xhr.send("district=" + district);
            }
        });
    </script>

</body>

</html>