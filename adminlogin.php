<?php

include 'database.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reg</title>
</head>
<body>

<!--just a check datas go to database-->

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
  <label for="email">Email</label>
  <input type="text" id="email" name="email" placeholder="Your email..">

  <label for="password">Password</label>
  <input type="text" id="password" name="password" placeholder="Your password..">

  
 
  
  <input type="submit" value="Submit">
</form>

    
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "<script>alert('All fields are required.');</script>";
        exit;

    }

    else {
        $sql = "INSERT INTO admin (email, password) VALUES ('$email', '$password')";

        mysqli_query($conn, $sql);
        echo "<script>alert('Admin registered successfully.');</script>";
    }

    mysqli_close($conn);

}

?>
