<?php

include 'database.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Donor-Registration</title>
</head>

<body>

    <header class="navbar">
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

            <h2>User Registration</h2>

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label>NIC</label>
                <input type="text" name="nic" class="form-control">
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control">
            </div>

            <div class="mb-3">
                <label>District</label>
                <input type="text" name="district" class="form-control">
            </div>

            <div class="mb-3">
                <label>Contact Number</label>
                <input type="text" name="telephone" class="form-control">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn-login">Register</button>

            <p class="signup-text">
                Already have an account? <a href="userlogin.php">Login</a>
            </p>

        </form>

    </div>


    

</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $district = $_POST['district'];
    $password = $_POST['password'];

    if (empty($name) || empty($nic) || empty($address) || empty($telephone) || empty($email) || empty($district) || empty($password)) {
        echo "<script>alert('All fields are required.');</script>";
        exit;


    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.');</script>";
        exit;
    }

    if (!is_numeric($telephone) || strlen($telephone) == 10) {
        echo "<script>alert('Contact number must be numeric 10 digits.');</script>";
        exit;
    } else {
        $sql = "INSERT INTO users (name, nic, address, telephone, email, district, password) VALUES ('$name', '$nic', '$address', '$telephone', '$email', '$district', '$password')";

        mysqli_query($conn, $sql);
        echo "<script>
        alert('Registration successful.');
        window.location.href='userlogin.php';
      </script>";
        exit;
    }

    mysqli_close($conn);

}

?>