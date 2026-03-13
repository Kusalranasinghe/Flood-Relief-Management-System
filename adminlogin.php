<?php
include 'database.php';
session_start();

$login_error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields.');</script>";
        exit;
    } else {
        $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_email'] = $row['email'];
            header("Location: admindashboard.php");
            exit;
        } else {
            $login_error = "⚠️ Access Denied. Invalid Credentials.";
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
    <title>Admin Login</title>
</head>

<body>

    <header class="navbar">
        <div class="logo">#HelpSriLanka </div>
        <nav>
            <a href="index.php">Home</a>
            <a href="#footer">Contact</a>
            <button class="btn-login" style="width:auto;padding:10px 24px;" onclick="window.location.href='userlogin.php'">User Login</button>
        </nav>
    </header>

    <div class="form">
        <div class="login-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="login-card">
                <div class="badge" style="margin-bottom: 20px; display: block; text-align: center;">🔒 Secure Admin Access</div>

                <div class="mb-3">
                    <label>Administrator Email</label>
                    <input type="text" name="email" id="admin_email" class="form-control" placeholder="Enter administrator email">
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" id="admin_password" class="form-control" placeholder="Enter password">
                </div>

                <?php if (isset($login_error)): ?>
                    <div style="color:#ff4d4d;font-size:13px;margin-bottom:12px;text-align:center;"> <?php echo $login_error; ?></div>
                <?php endif; ?>
                <button type="submit" class="btn-login">Verify Credentials</button>
                <p class="signup-text">
                    Authorized Personnel Only
                </p>
            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>