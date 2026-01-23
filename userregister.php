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

    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <h1>User Registration</h1>

        <label>Name</label>
        <input type="text" id="name" name="name" class="form-control mb-2">

        <label>Nic</label>
        <input type="text" id="nic" name="nic" class="form-control mb-2">

        <label>Address</label>
        <input type="text" id="address" name="address" class="form-control mb-2">

        <label>Contact Number</label>
        <input type="text" id="telephone" name="telephone" class="form-control mb-2">

        <label>Email</label>
        <input type="text" id="email" name="email" class="form-control mb-2">

        <label>Password</label>
        <input type="password" class="form-control mb-2" id="password" name="password">

        <button class="btn btn-danger w-100">Register</button>
    </form>

</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($name) || empty($nic) || empty($address) || empty($telephone) || empty($email) || empty($password)) {
        echo "<script>alert('All fields are required.');</script>";
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