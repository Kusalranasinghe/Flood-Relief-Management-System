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
    <title>Reilief Request</title>
</head>

<body>

    <div class="request-container">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="request-card">

            <h2>Flood Relief Request</h2>

            <div class="mb-3">
                <label>User ID</label>
                <input type="text" name="u_id" class="form-control">
            </div>

            <div class="mb-3">
                <label>Type of Relief</label>
                <select name="type" class="form-control">
                    <option value="food">Food</option>
                    <option value="water">Water</option>
                    <option value="medicine">Medicine</option>
                    <option value="shelter">Shelter</option>
                </select>
            </div>

            <div class="mb-3">
                <label>District</label>
                <input type="text" name="district" class="form-control">
            </div>

            <div class="mb-3">
                <label>Divisional Secretariat Division</label>
                <input type="text" name="ds_div" class="form-control">
            </div>

            <div class="mb-3">
                <label>Grama Niladari Division</label>
                <input type="text" name="gn_div" class="form-control">
            </div>

            <div class="mb-3">
                <label>Person's Name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label>Telephone</label>
                <input type="text" name="telephone" class="form-control">
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control">
            </div>

            <div class="mb-3">
                <label>Number of Family Members</label>
                <input type="number" name="no_of_members" class="form-control">
            </div>

            <div class="mb-3">
                <label>Flood Severity Level</label>
                <select name="sev_level" class="form-control">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn-request">Send Request</button>

        </form>

    </div>

</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $u_id = $_POST['u_id'];
    $type = $_POST['type'];
    $district = $_POST['district'];
    $ds_div = $_POST['ds_div'];
    $gn_div = $_POST['gn_div'];
    $name = $_POST['name'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $no_of_members = $_POST['no_of_members'];
    $sev_level = $_POST['sev_level'];
    $description = $_POST['description'];

    if (empty($u_id) || empty($type) || empty($district) || empty($ds_div) || empty($gn_div) || empty($name) || empty($telephone) || empty($address) || empty($no_of_members) || empty($sev_level) || empty($description)) {
        echo "<script>alert('All fields are required.');</script>";
        exit;

    }

    if (!is_numeric($u_id) || !is_numeric($telephone) || !is_numeric($no_of_members)) {
        echo "<script>alert('User ID, Telephone and Number of family members must be numeric.');</script>";
        exit;
    }

    if ($no_of_members <= 0) {
        echo "<script>alert('Number of family members must be a positive number.');</script>";
        exit;
    } else {
        $sql = "INSERT INTO requests (user_id, type, district, ds_div, gn_div, name, telephone, address, no_of_fmembers, sev_level, description, status) VALUES ('$u_id', '$type', '$district', '$ds_div', '$gn_div', '$name', '$telephone', '$address', '$no_of_members', '$sev_level', '$description', 'pending')";

        mysqli_query($conn, $sql);
        echo "<script>
        alert('Request submitted successfully.');
        window.location.href='userdashboard.php';
      </script>";


        mysqli_close($conn);

    }

}

?>