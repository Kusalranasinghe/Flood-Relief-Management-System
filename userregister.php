<?php
include 'database.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: userdashboard.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $nic = trim($_POST['nic']);
    $address = trim($_POST['address']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);
    $district = $_POST['district'];
    $password = $_POST['password'];

    if (empty($name) || empty($nic) || empty($address) || empty($telephone) || empty($email) || empty($district) || empty($password)) {
        echo "<script>alert('All fields are required.');
        window.location.href='userregister.php';
        </script>";
        exit;

    }

    if (!preg_match("/^[0-9]{9}[VvXx]$/", $nic) && !preg_match("/^[0-9]{12}$/", $nic)) {
        echo "<script>alert('Please enter a valid NIC number.');
        window.location.href='userregister.php';
        </script>";
        exit;

    }

    if (!preg_match("/^[0-9]{9}$/", $telephone)) {
        echo "<script>alert('Please enter a valid telephone number with exactly 9 digits.');
        window.location.href='userregister.php';
        </script>";
        exit;

    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.');
            window.location.href='userregister.php';
            </script>";
        exit;

    }

    if (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long.');
                window.location.href='userregister.php';
                </script>";
        exit;

    } else {
        $sql = "INSERT INTO users (name, nic, address, telephone, email, password) VALUES ('$name', '$nic', '$address', '$telephone', '$email', '$password')";

        mysqli_query($conn, $sql);
        echo "<script>
        alert('Registration successful.');
        window.location.href='userdashboard.php';
      </script>";
        exit;
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
                    <input type="text" name="name" class="form-control" placeholder="Enter your full name">
                </div>

                <div class="mb-3">
                    <label>NIC Number</label>
                    <div style="position:relative;">
                        <input type="text" name="nic" class="form-control" placeholder="e.g. 123456789V or 200012345678"
                            id="nic_input">
                        <span id="nic_tick"
                            style="position:absolute;right:12px;top:50%;transform:translateY(-50%);color:#22c55e;font-size:16px;display:none;">✓</span>
                    </div>
                    <small id="nic_error" style="color:#ff4d4d;display:none;"></small>
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Enter your address">
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
                                placeholder="7XXXXXXXX" maxlength="9">
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
                            placeholder="e.g. example@gmail.com">
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