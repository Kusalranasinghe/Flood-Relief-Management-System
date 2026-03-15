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
</head>

<body>

    <div class="request-container">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="request-card">

            <h2>Volunteer Registration</h2>
            <title>Volunteer Registration</title>
                  
            <div class="mb-3">
                <label>Type of Volunteer Work</label>
                <select name="type" class="form-control">
                    <option value="food">Food/Water Distribution</option>
                    <option value="medicine">Medicine Distribution</option>
                    <option value="shelter">Shelter Management</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your full name">
            </div>


            <div class="mb-3">
                <label>NIC</label>
                <input type="text" name="nic" class="form-control" placeholder="Enter your NIC">
            </div>

            

            <div class="mb-3">
                <label>Telephone</label>
                <div class="input-group">
                    <span class="input-group-text" style="background:rgba(255,255,255,0.08);border:none;color:white;">+94</span>
                    <input type="number" name="telephone" id="phone_input" class="form-control" placeholder="7XXXXXXXX" maxlength="9" oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,9)">
                </div>
                <small id="phone_error" style="color:#ff4d4d;display:none;">Please enter exactly 9 digits.</small>
            </div>


            <button type="submit" class="btn-request">Register</button>
            <a href="userdashboard.php" style="display:block;text-align:center;margin-top:12px;color:#f97316;font-size:14px;">← Back to Dashboard</a>
        </form>

    </div>
    <script src="script.js"></script>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $type = $_POST['type'];
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $telephone = $_POST['telephone'];

    if (empty($type) || empty($name) || empty($nic) || empty($telephone)) {
        echo "<script>alert('Please fill in all required fields.');</script>";
        exit;
    }

    }
    if (!is_numeric($telephone) ) {
        echo "<script>alert('Telephone must be numeric.');</script>";
        exit;
    }



     else {
        $sql = "INSERT INTO volunteers (type,name,nic, telephone) VALUES ('$type', '$name', '$nic', '$telephone')";

        mysqli_query($conn, $sql);
        echo "<script>
    alert('Your volunteer registration has been submitted successfully.');
    window.location.href='userdashboard.php';
</script>";

        mysqli_close($conn);
    }


?>
