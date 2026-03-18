<?php
include 'database.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: userdashboard.php");
    exit;
}

$login_error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nic = trim($_POST['nic']);
    $password = $_POST['password'];

    if (empty($nic) || empty($password)) {
        $login_error = "Please fill in all fields.";
    } else {

        // Get user by NIC ONLY
        $sql = "SELECT * FROM users WHERE nic='$nic'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Verify hashed password
            if (password_verify($password, $row['password'])) {

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['nic'] = $row['nic'];

                header("Location: userdashboard.php");
                exit;

            } else {
                $login_error = "Invalid NIC or password. Please try again.";
            }

        } else {
            $login_error = "Invalid NIC or password. Please try again.";
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>User Login</title>
</head>

<body>
    <header class="navbar" style="padding: 20px; padding-left: 80px; padding-right: 80px;">
        <div class="logo">#HelpSriLanka</div>
        <nav>
            <a href="index.php">Home</a>
            <a href="#footer">Contact</a>
            <button class="btn-login" style="width:auto;padding:10px 24px;" onclick="window.location.href='adminlogin.php'">Admin</button>
        </nav>
    </header>

    <div class="form">
        <div class="login-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="login-card">

                <h2>User Login</h2>
                <p style="color:#94a3b8;font-size:13px;text-align:center;margin-bottom:20px;">Sign in to submit or manage your relief requests</p>

                <div class="mb-3">
                    <label>NIC Number</label>
                    <input type="text" name="nic" class="form-control" placeholder="Enter your NIC number">
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password">
                </div>

                <?php if ($login_error): ?>
                    <div style="color:#ff4d4d;font-size:13px;margin-bottom:12px;text-align:center;">
                        <?php echo $login_error; ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn-login">Sign In</button>

                <p class="signup-text">
                    Don't have an account? <a href="userregister.php">Sign Up</a>
                </p>

            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>

</html>