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
            <a href="#footer">Contact</a>

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

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];


    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields.');</script>";
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
            echo "<script>alert('Invalid email or password.');</script>";
        }
    }

    mysqli_close($conn);
}
?>