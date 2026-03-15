<?php
include 'database.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: userdashboard.php");
    exit;
}

$reg_error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $nic = trim($_POST['nic']);
    $address = trim($_POST['address']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);
    $district = $_POST['district'];
    $password = $_POST['password'];

    if (empty($name) || empty($nic) || empty($address) || empty($telephone) || empty($district) || empty($password)) {
        $reg_error = "All fields are required except email.";
    } elseif (!preg_match('/^([0-9]{9}[VvXx]|[0-9]{12})$/', $nic)) {
        $reg_error = "NIC must be 9 digits followed by V or X, or 12 digits.";
    } elseif (!is_numeric($telephone) || strlen($telephone) != 9) {
        $reg_error = "Contact number must be exactly 9 digits after +94.";
    } elseif (strlen($password) < 6) {
        $reg_error = "Password must be at least 6 characters.";
    } elseif (
        !empty($email) && (
            !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            !preg_match('/@(gmail\.com|yahoo\.com|hotmail\.com|outlook\.com|icloud\.com|live\.com)$/i', $email)
        )
    ) {
        $reg_error = "Please use a valid email (Gmail, Yahoo, Hotmail, Outlook, iCloud or Live).";
    } else {
        $checkEmail = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
        if (!empty($email) && mysqli_num_rows($checkEmail) > 0) {
            $reg_error = "This email is already registered. Please login.";
        } else {
            $sql = "INSERT INTO users (name, nic, address, telephone, email, district, password) 
                VALUES ('$name', '$nic', '$address', '$telephone', '$email', '$district', '$password')";
            mysqli_query($conn, $sql);
            echo "<script>
            alert('Registration successful. Please login.');
            window.location.href='userlogin.php';
        </script>";
            exit;
        }
    }
    mysqli_close($conn);
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
    <title>User Registration</title>
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

    <div class="form1" style="padding:50px;padding-top:140px;">
        <div class="login-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="register-card">

                <h2>User Registration</h2>
                <p style="color:#94a3b8;font-size:13px;text-align:center;margin-bottom:20px;">Create your account to
                    submit flood relief requests</p>

                <div class="mb-3">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your full name"
                        value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                </div>

                <div class="mb-3">
                    <label>NIC Number</label>
                    <div style="position:relative;">
                        <input type="text" name="nic" class="form-control" placeholder="e.g. 123456789V or 200012345678"
                            id="nic_input"
                            value="<?php echo isset($_POST['nic']) ? htmlspecialchars($_POST['nic']) : ''; ?>">
                        <span id="nic_tick"
                            style="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#22c55e;font-size:16px;display:none;">✓</span>
                    </div>
                    <small id="nic_error" style="color:#ff4d4d;display:none;"></small>
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Enter your address"
                        value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
                </div>

                <div class="mb-3">
                    <label>District</label>
                    <select name="district" class="form-control" required>
                        <option value="">Select District</option>
                        <?php
                        $distRes = mysqli_query($conn, "SELECT name FROM districts ORDER BY name ASC");
                        while ($distRow = mysqli_fetch_assoc($distRes)) {
                            $selected = (isset($_POST['district']) && $_POST['district'] == $distRow['name']) ? 'selected' : '';
                            echo "<option value='{$distRow['name']}' {$selected}>{$distRow['name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Contact Number</label>
                    <div style="position:relative;">
                        <div class="input-group">
                            <span class="input-group-text"
                                style="background:rgba(255,255,255,0.08);border:none;color:white;">+94</span>
                            <input type="text" name="telephone" id="reg_phone_input" class="form-control"
                                placeholder="7XXXXXXXX" maxlength="9"
                                value="<?php echo isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : ''; ?>">
                        </div>
                        <span id="reg_phone_tick"
                            style="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#22c55e;font-size:16px;display:none;">✓</span>
                    </div>
                    <small id="reg_phone_error" style="color:#ff4d4d;display:none;"> Please enter exactly 9
                        digits.</small>
                </div>

                <div class="mb-3">
                    <label>Email <span style="color:#94a3b8;font-size:12px;">(optional)</span></label>
                    <div style="position:relative;">
                        <input type="text" name="email" id="reg_email" class="form-control"
                            placeholder="e.g. example@gmail.com"
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <span id="email_tick"
                            style="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#22c55e;font-size:16px;display:none;">✓</span>
                    </div>
                    <small id="reg_email_error" style="color:#ff4d4d;display:none;"> Please enter a valid email
                        address.</small>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <div style="position:relative;">
                        <input type="password" name="password" id="reg_password" class="form-control"
                            placeholder="Create a password">
                        <span id="password_tick"
                            style="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#22c55e;font-size:16px;display:none;">✓</span>
                    </div>
                    <small id="reg_password_error" style="color:#ff4d4d;display:none;"> Password must be at least 6
                        characters.</small>
                </div>

                <?php if ($reg_error): ?>
                    <div style="color:#ff4d4d;font-size:13px;margin-bottom:12px;text-align:center;">
                        <?php echo $reg_error; ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn-register">Create Account</button>

                <p class="signup-text">
                    Already have an account? <a href="userlogin.php">Sign In</a>
                </p>

            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>

</html>