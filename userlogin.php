<?php

include 'database.php';
session_start();


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
        <div class="logo">#HelpSriLanka </div>

        <nav>
            <a href="index.php">Home</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>

            <button class="start-btn" onclick="window.location.href='adminlogin.php'">Admin</button>


        </nav>



    </header>

    <div class="form">

        <div class="login-container">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="login-card">

                <h2>User Login</h2>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <button type="submit" class="btn-login">Sign In</button>

                <p class="signup-text">
                    Don't have an account? <a href="userregister.php">Sign Up</a>
                </p>

            </form>

        </div>


    </div>

    <footer class="footer">

        <div class="footer-container">

            <div class="footer-col">
                <h2>Flood Relief Center</h2>
                <p>
                    Supporting communities affected by floods through emergency
                    coordination, real-time information, and relief services.
                </p>
            </div>

            <div class="footer-col">
                <h3 style="color: red;">Emergency Help</h3>
                <ul style="font-size: 19px; color:aliceblue">
                    <li>+94112420250</li>
                    <li>+94112220938</li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Resources</h3>
                <ul>
                    <li><a href="#">Safety Guidelines</a></li>
                    <li><a href="#">Relief Centers</a></li>
                    <li><a href="#">Donate</a></li>
                    <li><a href="#">Volunteer</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Legal</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© 2026 Flood Relief Support Center | All Rights Reserved</p>
        </div>

    </footer>


</body>

</html>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];


    if (empty($email) || empty($password)) {
        echo "All fields are required.";
        exit;
    } else {

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_assoc($result);


            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['email'] = $row['email'];


            header("Location: userdashboard.php");

            exit;

        } else {
            echo "Invalid email or password.";
        }
    }

    mysqli_close($conn);
}
?>