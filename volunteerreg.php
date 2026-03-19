<?php
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Volunteer Registration</title>
        <link rel="stylesheet" href="styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>

<body>

    <header class="navbar" style="padding:20px;padding-left:80px;padding-right:80px;">
        <div class="logo">#HelpSriLanka</div>
        <nav>
            <a href="index.php">Home</a>
            <a href="#footer">Contact</a>
            <button class="btn-login" style="width:auto;padding:10px 24px;"
                onclick="window.location.href='adminlogin.php'">Admin</button>
        </nav>
    </header>

    <div class="request-container" style="padding-top:120px;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="request-card">

            <h2>Volunteer Registration</h2>
            <p style="color:#94a3b8;font-size:13px;text-align:center;margin-bottom:20px;">Register to help flood
                affected communities</p>
            <div class="mb-3">
                <label>Type of Volunteer Work</label>
                <select name="type" class="form-control">
                    <option value="food">Food/Water Distribution</option>
                    <option value="medicine">Medicine Distribution</option>
                    <option value="shelter">Shelter Management</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your full name">
            </div>


            <div class="mb-3">
                <label>NIC Number</label>
                <div style="position:relative;">
                    <input type="text" name="nic" id="nic_input" class="form-control"
                        placeholder="e.g. 123456789V or 200012345678">
                    <span id="nic_tick"
                        style="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#22c55e;font-size:16px;display:none;">✓</span>
                </div>
                <small id="nic_error" style="color:#ff4d4d;display:none;"></small>
            </div>


            <div class="mb-3">
                <label>Telephone</label>
                <div style="position:relative;">
                    <div class="input-group">
                        <span class="input-group-text"
                            style="background:rgba(255,255,255,0.08);border:none;color:white;">+94</span>
                        <input type="text" name="telephone" id="reg_phone_input" class="form-control"
                            placeholder="7XXXXXXXX" maxlength="9">
                    </div>
                    <span id="reg_phone_tick"
                        style="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#22c55e;font-size:16px;display:none;">✓</span>
                </div>
                <small id="reg_phone_error" style="color:#ff4d4d;display:none;">Please enter exactly 9 digits.</small>
            </div>


            <button type="submit" class="btn-request">Register</button>
            <div
                style="text-align:center;margin-top:20px;padding-top:16px;border-top:1px solid rgba(255,255,255,0.06);">
                <a href="index.php" class="faded-back-link">← Back to Dashboard</a>
            </div>
        </form>

    </div>
    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>


</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $type = $_POST['type'];
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $telephone = $_POST['telephone'];

    if (empty($type) || empty($name) || empty($nic) || empty($telephone)) {
        echo "<script>alert('Please fill in all required fields.');</script>";
        exit;
    }

    if (!preg_match("/^[0-9]{9}[VvXx]$/", $nic) && !preg_match("/^[0-9]{12}$/", $nic)) {
        echo "<script>alert('Please enter a valid NIC number.');</script>";
        exit;
    }

    if (!preg_match("/^[0-9]{9}$/", $telephone)) {
        echo "<script>alert('Please enter a valid telephone number with exactly 9 digits.');</script>";
        exit;

    }
    
    else {
        $sql = "INSERT INTO volunteers (type,name,nic, telephone)  VALUES ('$type', '$name', '$nic', '$telephone')";

        echo "<script>
        alert('Your volunteer registration has been submitted successfully.');
        window.location.href='index.php';
    </script>";

        mysqli_query($conn, $sql);
    }

    mysqli_close($conn);

}

?>