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

    <div class="form">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <h3>Flood Reilief Requests</h3> <br>

        <label for="u_id">User ID</label>
        <input type="text" id="u_id" name="u_id" class="form-control mb-2"> <br>

        <label for="type">Type of Reilief </label>
        <select id="type" name="type">
            <option value="food">Food</option>
            <option value="water">Water</option>
            <option value="medicine">Medicine</option>
            <option value="shelter">Shelter</option>
        </select> <br><br>

        <label for="district">District</label>
        <input type="text" id="district" name="district" class="form-control mb-2">

        <label for="ds_div">Divisional Secretariat Division</label>
        <input type="text" id="ds_div" name="ds_div" class="form-control mb-2">

        <label for="gn_div">Grama Niladari Division</label>
        <input type="text" id="gn_div" name="gn_div" class="form-control mb-2">

         <label for="name">Person's Name</label>
        <input type="text" id="name" name="name" class="form-control mb-2">

        <label for="telephone">Telephone</label>
        <input type="text" id="telephone" name="telephone"  class="form-control mb-2">

        <label for="address">Address</label>
        <input type="text" id="address" name="address" class="form-control mb-2">

        <label for="no_of_members">Number of Family Members</label>
        <input type="text" id="no_of_members" name="no_of_members"  class="form-control mb-2"> <br>

        <label for="sev_level">Flood severity level</label>
        <select id="sev_level" name="sev_level">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select> <br><br>

        <label for="description">Description</label>
        <input type="text" id="description" name="description"  class="form-control mb-2"> <br>


        <button class="btn btn-danger w-100">Sent Request</button>

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
    }

    else { 
        $sql = "INSERT INTO requests (user_id, type, district, ds_div, gn_div, name, telephone, address, no_of_fmembers, sev_level, description, status) VALUES ('$u_id', '$type', '$district', '$ds_div', '$gn_div', '$name', '$telephone', '$address', '$no_of_members', '$sev_level', '$description', 'pending')";

        mysqli_query($conn, $sql );
        echo "<script>
        alert('Request submitted successfully.');
        window.location.href='userdashboard.php';
      </script>";
    

    mysqli_close($conn);

    }

}

?>