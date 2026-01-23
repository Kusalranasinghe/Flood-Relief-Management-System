<?php

include 'database.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <h3>Admin Login</h3>

        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Your email..">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Your password..">

        <input type="submit" value="Submit">



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
        $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            header("Location: admindashboard.php");
        } else {
            echo "Invalid email or password.";
        }
    }

    mysqli_close($conn);
}