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

    <div class="form">

        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

            <h3>User Login</h3>

            <label>Email</label>
            <input type="text" id="email" name="email" class="form-control mb-2">

            <label>Password</label>
            <input type="password" class="form-control mb-2" id="password" name="password">

            <button class="btn btn-danger w-100">Sign In</button>

            <p>Don't have an account? <a href="userregister.php">Sign Up</a></p>
    
        </form>
    </div>


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