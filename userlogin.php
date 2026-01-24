<?php

include 'database.php';
session_start();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <h3>User Login</h3>

        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Your email..">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Your password..">

        <input type="submit" value="Submit">

        <a href="userregister.php">Don't have an account? Register here</a>


    </form>


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
